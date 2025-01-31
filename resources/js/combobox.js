class Combobox {
    constructor(container) {
      // Store the container element
      this.container = container;

      // Query the child elements inside this container
      this.inputEl = container.querySelector('[data-combobox-input]');
      this.buttonEl = container.querySelector('[data-combobox-button]');
      this.optionsListEl = container.querySelector('[data-combobox-options]');
      this.optionEls = Array.from(
        container.querySelectorAll('[data-combobox-option]')
      );

      // ** Hidden input to store the selected value for the form **
      this.hiddenValueEl = container.querySelector('[data-combobox-value]');

      // State
      this.isOpen = false;
      this.highlightedIndex = -1; // For keyboard navigation

      // Bind event handlers
      this.bindEvents();
    }

    bindEvents() {
      // Toggle list when button is clicked
      this.buttonEl.addEventListener('click', (e) => {
        e.stopPropagation();
        this.toggleList();
      });

      // Open list on input focus
      this.inputEl.addEventListener('focus', () => {
        this.openList();
      });

      // Handle typing in the input (optional: filter options)
      this.inputEl.addEventListener('input', (e) => {
        // Example: simple filter logic
        const query = e.target.value.toLowerCase();

        this.optionEls.forEach((optionEl) => {
          const text = optionEl.textContent.toLowerCase();
          optionEl.style.display = text.includes(query) ? 'block' : 'none';
        });

        // Open the list if there's a query
        if (query.trim()) {
          this.openList();
        }
      });

      // Handle keyboard navigation on the input
      this.inputEl.addEventListener('keydown', (e) => this.handleKeyDown(e));

      // Click on an option
      this.optionEls.forEach((optionEl, index) => {
        optionEl.addEventListener('click', (e) => {
          e.stopPropagation();
          this.selectOption(index);
        });

        // Optional: highlight on mouseenter
        optionEl.addEventListener('mouseenter', () => {
          this.highlightOption(index);
        });
      });

      // Close list if clicking outside the combobox
      document.addEventListener('click', (e) => {
        if (!this.container.contains(e.target)) {
          this.closeList();
        }
      });
    }

    toggleList() {
      if (this.isOpen) {
        this.closeList();
      } else {
        this.openList();
      }
    }

    openList() {
      this.isOpen = true;
      this.optionsListEl.classList.remove('hidden');
      this.inputEl.setAttribute('aria-expanded', 'true');
    }

    closeList() {
      this.isOpen = false;
      this.optionsListEl.classList.add('hidden');
      this.inputEl.setAttribute('aria-expanded', 'false');
      this.highlightedIndex = -1;
      this.clearHighlightStyles();
    }

    handleKeyDown(e) {
      const { key } = e;

      // Only act if list is open (except for ArrowDown which can open it)
      if (!this.isOpen && key !== 'ArrowDown' && key !== 'Enter') return;

      switch (key) {
        case 'ArrowDown':
          e.preventDefault();
          // If the list is closed, open it
          if (!this.isOpen) {
            this.openList();
          } else {
            this.moveHighlight(1);
          }
          break;
        case 'ArrowUp':
          e.preventDefault();
          this.moveHighlight(-1);
          break;
        case 'Enter':
          e.preventDefault();
          if (this.highlightedIndex >= 0) {
            this.selectOption(this.highlightedIndex);
          } else {
            this.closeList();
          }
          break;
        case 'Escape':
          this.closeList();
          break;
        default:
          break;
      }
    }

    moveHighlight(direction) {
      // Move highlight index among visible options
      const visibleOptions = this.optionEls.filter((el) => el.style.display !== 'none');
      if (!visibleOptions.length) return;

      // If nothing is highlighted, start at first or last index
      if (this.highlightedIndex === -1) {
        this.highlightedIndex = (direction > 0) ? 0 : visibleOptions.length - 1;
      } else {
        this.highlightedIndex =
          (this.highlightedIndex + direction + visibleOptions.length) % visibleOptions.length;
      }

      // Reflect highlight visually
      this.clearHighlightStyles();
      const highlightEl = visibleOptions[this.highlightedIndex];
      highlightEl.classList.add('bg-indigo-600', 'text-white');
    }

    highlightOption(index) {
      // Clear current highlight
      this.clearHighlightStyles();
      // Set new highlight
      this.highlightedIndex = index;
      this.optionEls[index].classList.add('bg-indigo-600', 'text-white');
    }

    clearHighlightStyles() {
      this.optionEls.forEach((el) => {
        el.classList.remove('bg-indigo-600', 'text-white');
      });
    }

    selectOption(index) {
      const optionEl = this.optionEls[index];
      if (!optionEl) return;

      // 1) Set the visible input's value (the display text)
      this.inputEl.value = optionEl.textContent.trim();

      // 2) Set the hidden input's value (the real ID or data-value)
      if (this.hiddenValueEl) {
        this.hiddenValueEl.value = optionEl.dataset.value || '';
      }

      // Close the list
      this.closeList();
    }
  }

  // Initialize all comboboxes on the page
  document.addEventListener('DOMContentLoaded', () => {
    const comboboxes = document.querySelectorAll('[data-combobox]');
    comboboxes.forEach((comboboxEl) => {
      new Combobox(comboboxEl);
    });
});