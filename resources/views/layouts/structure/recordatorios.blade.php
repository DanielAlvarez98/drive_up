                         @php($noti = userNotifications())

                         <div class="col-12 col-lg-3">

                             <div class="card">
                                 <div class="card-header">
                                     <h4>Proximo Recordatorios</h4>
                                 </div>
                                 <div class="card-content pb-4">

                                     @forelse($noti['items'] as $alert)
                                         <a href="{{ route('recorda.show') }}" class="text-decoration-none">
                                             <div
                                                 class="p-3 m-2 border rounded-3 border-secondary-subtle hover-border transition cursor-pointer">

                                                 <div
                                                     class="d-flex align-items-start justify-content-between mb-2 gap-2">
                                                     <h6 class="text-dark small flex-grow-1 mb-0">
                                                         {{ $alert['title'] }}
                                                     </h6>

                                                     <span
                                                         class="badge bg-{{ $alert['type'] }}-subtle text-{{ $alert['type'] }} border border-{{ $alert['type'] }}-subtle px-2 py-1 text-nowrap">
                                                         {{ $alert['urgencia'] }}
                                                     </span>
                                                 </div>
                                                 <p class="text-secondary small mb-2">
                                                     {{ $alert['car'] }}
                                                 </p>

                                                 <div class="d-flex align-items-center gap-1 text-secondary small">
                                                     <svg xmlns="http://www.w3.org/2000/svg" width="12"
                                                         height="12" viewBox="0 0 24 24" fill="none"
                                                         stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                         stroke-linejoin="round" class="me-1">
                                                         <path d="M8 2v4"></path>
                                                         <path d="M16 2v4"></path>
                                                         <rect width="18" height="18" x="3" y="4" rx="2">
                                                         </rect>
                                                         <path d="M3 10h18"></path>
                                                     </svg>

                                                     <span>{{ $alert['car-fecha'] }}</span>
                                                 </div>
                                             </div>
                                         </a>
                                     @empty
                                         <li class="dropdown-item text-center text-muted">
                                             Sin notificaciones
                                         </li>
                                     @endforelse


                                 </div>
                             </div>
                         </div>
