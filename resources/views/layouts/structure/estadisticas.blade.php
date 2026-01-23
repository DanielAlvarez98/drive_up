     <div class="row mb-4">
         <div class="col-6 col-lg-3 col-md-6">
             <div class="bg-gradient-vr border rounded-4 p-4 shadow-sm 
            hover-shadow transition">

                 <div class="d-flex align-items-start justify-content-between mb-4">
                     <div class=" p-3 rounded-4" style="background-color: #fff3">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="text-white">
                             <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9
                         C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3
                         c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9
                         l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"></path>
                             <circle cx="7" cy="17" r="2"></circle>
                             <path d="M9 17h6"></path>
                             <circle cx="17" cy="17" r="2"></circle>
                         </svg>
                     </div>
                 </div>
                 <h6 class="small mb-1" style="color: #fffc">
                     Vehículos Registrados
                 </h6>
                 <p class="text-white  fs-3 mb-1">
                     {{ user_car_stats()['total'] }}
                 </p>
                 <p class=" small d-flex align-items-center gap-1 mb-0" style="color: #fffc">
                     <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round">
                         <path d="M16 7h6v6"></path>
                         <path d="m22 7-8.5 8.5-5-5L2 17"></path>
                     </svg>
                     +{{ user_car_stats()['total'] }} este mes
                 </p>
             </div>

         </div>
         <div class="col-6 col-lg-3 col-md-6">
             <div class="bg-gradient-da border rounded-4 p-4 shadow-sm 
            hover-shadow transition">

                 <div class="d-flex align-items-start justify-content-between mb-4">
                     <div class=" p-3 rounded-4" style="background-color: #fff3">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="lucide lucide-file-text w-5 h-5 sm:w-6 sm:h-6 text-white"
                             aria-hidden="true">
                             <path
                                 d="M6 22a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h8a2.4 2.4 0 0 1 1.704.706l3.588 3.588A2.4 2.4 0 0 1 20 8v12a2 2 0 0 1-2 2z">
                             </path>
                             <path d="M14 2v5a1 1 0 0 0 1 1h5"></path>
                             <path d="M10 9H8"></path>
                             <path d="M16 13H8"></path>
                             <path d="M16 17H8"></path>
                         </svg>
                     </div>
                 </div>
                 <h6 class=" small mb-1" style="color: #fffc">
                     Documentos Activos
                 </h6>
                 <p class="text-white fs-3 mb-1">
                     {{ user_document_stats()['active'] }}
                 </p>
                 <p class=" small d-flex align-items-center gap-1 mb-0" style="color: #fffc">
                     <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round">
                         <path d="M16 7h6v6"></path>
                         <path d="m22 7-8.5 8.5-5-5L2 17"></path>
                     </svg>
                     {{ user_document_stats()['warning'] }} por vencer
                 </p>
             </div>
         </div>
         <div class="col-6 col-lg-3 col-md-6">
             <div class="bg-gradient-man border rounded-4 p-4 shadow-sm 
            hover-shadow transition">

                 <div class="d-flex align-items-start justify-content-between mb-4">
                     <div class=" p-3 rounded-3" style="background-color: #fff3">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="lucide lucide-wrench w-5 h-5 sm:w-6 sm:h-6 text-white"
                             aria-hidden="true">
                             <path
                                 d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.106-3.105c.32-.322.863-.22.983.218a6 6 0 0 1-8.259 7.057l-7.91 7.91a1 1 0 0 1-2.999-3l7.91-7.91a6 6 0 0 1 7.057-8.259c.438.12.54.662.219.984z">
                             </path>
                         </svg>
                     </div>
                 </div>
                 <h6 class=" small mb-1" style="color: #fffc">
                     Mantenimientos </h6>
                 <p class="text-white fs-3 mb-1">
                     {{ user_maintenance_stats()['total'] }}
                 </p>
                 <p class=" small d-flex align-items-center gap-1 mb-0" style="color: #fffc">
                     <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round">
                         <path d="M16 7h6v6"></path>
                         <path d="m22 7-8.5 8.5-5-5L2 17"></path>
                     </svg>
                     S/ {{ number_format(user_maintenance_stats()['total_price'], 2) }} total
                 </p>
             </div>
         </div>
         <div class="col-6 col-lg-3 col-md-6">
             <div class="bg-gradient-rec border rounded-3 p-4 shadow-sm 
            hover-shadow transition">

                 <div class="d-flex align-items-start justify-content-between mb-4">
                     <div class=" p-3 rounded-3" style="background-color: #fff3">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="lucide lucide-circle-alert w-5 h-5 sm:w-6 sm:h-6 text-white"
                             aria-hidden="true">
                             <circle cx="12" cy="12" r="10"></circle>
                             <line x1="12" x2="12" y1="8" y2="12"></line>
                             <line x1="12" x2="12.01" y1="16" y2="16"></line>
                         </svg>
                     </div>
                 </div>
                 <h6 class=" small mb-1" style="color: #fffc">
                     Recordatorios
                 </h6>
                 <p class="text-white fs-3 mb-1">
                     {{ user_week_alerts()['total_month'] }}

                 </p>
                 <p class="small d-flex align-items-center gap-1 mb-0" style="color: #fffc">
                     <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round">
                         <path d="M16 7h6v6"></path>
                         <path d="m22 7-8.5 8.5-5-5L2 17"></path>
                     </svg>
                     {{ user_week_alerts()['total_week'] }} esta semana
                 </p>
             </div>
         </div>
     </div>
