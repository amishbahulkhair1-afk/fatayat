@props(['name', 'label' => null, 'value' => null, 'required' => false])

<div class="space-y-2">
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
            {{ $label }}
        </label>
    @endif

    <div x-data x-init="flatpickr($refs.input, {
        enableTime: true,
        noCalendar: true,
        dateFormat: 'H:i',
        time_24hr: true,
        allowInput: true,
        minuteIncrement: 5,
        disableMobile: true,
        static: true
    })" class="relative">
        <input x-ref="input" type="text" id="{{ $name }}" name="{{ $name }}"
            value="{{ old($name, $value) }}" @if ($required) required @endif placeholder="--:--"
            class="w-full rounded-2xl border border-gray-200 bg-white pl-4 pr-12 py-2.5 text-sm font-medium text-gray-700 shadow-sm hover:border-green-300 focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-200" />

        <button type="button" @click="$refs.input._flatpickr.open()"
            class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-green-600 transition-all duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </button>

    </div>


    @error($name)
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

@once
    @push('styles')
        <style>
            /* =========================================
               FLATPICKR - MINI TIME PICKER
               ========================================= */

            .flatpickr-calendar,
            .flatpickr-calendar.noCalendar {
                width: 120px !important;
                min-width: 120px !important;
                max-width: 120px !important;

                border: 1px solid #d1fae5 !important;
                border-radius: 8px !important;

                box-shadow: 0 5px 12px rgba(0, 0, 0, 0.10) !important;

                overflow: hidden !important;
            }

            /* Container waktu */
            .flatpickr-time {
                width: 120px !important;
                min-width: 120px !important;
                max-width: 120px !important;

                height: 42px !important;
                min-height: 42px !important;
                max-height: 42px !important;

                padding: 0 !important;
                margin: 0 !important;

                display: flex !important;
                align-items: center !important;
                justify-content: center !important;

                border: 0 !important;
            }

            /* Jam */
            .flatpickr-time input.flatpickr-hour,

            /* Menit */
            .flatpickr-time input.flatpickr-minute {
                width: 35px !important;
                min-width: 35px !important;
                max-width: 35px !important;

                height: 27px !important;
                min-height: 27px !important;
                max-height: 27px !important;

                padding: 0 !important;
                margin: 0 2px !important;

                border: 1px solid #e5e7eb !important;
                border-radius: 5px !important;

                font-size: 12px !important;
                font-weight: 600 !important;

                line-height: 27px !important;

                box-sizing: border-box !important;
            }

            /* Fokus */
            .flatpickr-time input.flatpickr-hour:focus,
            .flatpickr-time input.flatpickr-minute:focus {
                background: #dcfce7 !important;
                color: #166534 !important;
                border-color: #86efac !important;

                outline: none !important;
                box-shadow: none !important;
            }

            /* Hover */
            .flatpickr-time input.flatpickr-hour:hover,
            .flatpickr-time input.flatpickr-minute:hover {
                background: #f0fdf4 !important;
                border-color: #86efac !important;
            }

            /* Tanda ":" */
            .flatpickr-time .flatpickr-time-separator {
                width: 5px !important;
                min-width: 5px !important;
                max-width: 5px !important;

                margin: 0 !important;
                padding: 0 !important;

                font-size: 12px !important;
                font-weight: 700 !important;
                color: #6b7280 !important;
            }

            /* Karena menggunakan time_24hr: true */
            .flatpickr-am-pm {
                display: none !important;
            }

            /* Hilangkan spinner */
            .flatpickr-time .numInputWrapper span {
                display: none !important;
            }

            /* Hilangkan ruang tambahan */
            .flatpickr-calendar .flatpickr-innerContainer,
            .flatpickr-calendar .flatpickr-rContainer {
                width: 100% !important;
                min-width: 0 !important;
                padding: 0 !important;
                margin: 0 !important;
            }
        </style>
    @endpush
@endonce
