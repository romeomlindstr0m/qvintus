@vite('resources/js/combobox.js')
<div class="combobox" data-combobox>
    <label
      for="combobox-input-{{ $id }}"
      class="block text-sm font-medium text-gray-900"
    >
      {{ $label }}
    </label>
  
    <!-- Wrapper -->
    <div class="relative mt-2">
      <!-- The visible text input (not submitted by default unless you add a name) -->
      <input
        id="combobox-input-{{ $id }}"
        value="{{ $selected_name }}"
        type="text"
        class="block w-full rounded-md bg-white py-1.5 pl-3 pr-12 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm"
        role="combobox"
        aria-controls="combobox-options-1"
        aria-expanded="false"
        data-combobox-input
        placeholder="Type to search..."
      />
  
      <!-- Hidden input that will store the actual value for form submission -->
      <input
        type="hidden"
        value="{{ $selected_id }}"
        name="combobox-value-{{ $id }}"
        data-combobox-value
        required
      />
  
      <!-- Button (toggle) -->
      <button
        type="button"
        class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none"
        data-combobox-button
        aria-label="Toggle menu"
      >
        <!-- Down/Up Chevron SVG -->
        <svg
          class="size-5 text-gray-400"
          viewBox="0 0 20 20"
          fill="currentColor"
          aria-hidden="true"
        >
          <path 
            fill-rule="evenodd" 
            d="M10.53 3.47a.75.75 0 0 0-1.06 0L6.22 6.72a.75.75 0 0 0 1.06 1.06L10 5.06l2.72 2.72a.75.75 0 1 0 1.06-1.06l-3.25-3.25Zm-4.31 9.81 3.25 3.25a.75.75 0 0 0 1.06 0l3.25-3.25a.75.75 0 1 0-1.06-1.06L10 14.94l-2.72-2.72a.75.75 0 0 0-1.06 1.06Z" 
            clip-rule="evenodd" />
        </svg>
      </button>
  
      <!-- Options List -->
      <ul
        id="combobox-options-{{ $id }}"
        class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm hidden"
        role="listbox"
        data-combobox-options
      >
      @foreach ($options as $option)
        <li
          class="relative cursor-default select-none py-2 pl-3 pr-9 text-gray-900 hover:bg-indigo-600 hover:text-white"
          role="option"
          tabindex="-1"
          data-combobox-option
          data-value="{{ $option['value'] }}"
        >
          {{ $option['name'] }}
        </li>
      @endforeach
      </ul>
    </div>
  </div>  