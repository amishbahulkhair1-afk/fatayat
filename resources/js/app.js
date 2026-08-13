import "../css/app.css";

import Alpine from "alpinejs";
import "flowbite";
import ApexCharts from "apexcharts";

// Flatpickr
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import { Indonesian } from "flatpickr/dist/l10n/id.js";

window.Alpine = Alpine;
window.ApexCharts = ApexCharts;
window.flatpickr = flatpickr;

flatpickr.localize(Indonesian);

Alpine.start();
