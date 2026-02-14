@php($noti = userNotifications())

<div class="col-12 col-lg-3">

    <div class="card">
        <div class="card-header">
            <h4>Proximo Recordatorios</h4>
        </div>
        <div class="card-content pb-4">

            @forelse($noti['items'] as $alert)
                <a href="{{ route('recorda.show') }}" class="text-decoration-none">
                    <div class="p-3 m-2 border rounded-3 border-secondary-subtle hover-border transition cursor-pointer">

                        <div class="d-flex align-items-start justify-content-between mb-2 gap-2">
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
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

    <!-- FREE -->
    @if (Auth::user()->plan == 0)
        <div class="p-4 p-lg-4 rounded-4 border position-relative overflow-hidden"
            style="background: linear-gradient(135deg,#f9fafb,#f3f4f6); border-color:#e5e7eb;">

            <div class="d-flex align-items-start gap-3">

                <!-- ICONO -->
                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                    style="width:48px;height:48px;background:#9ca3af;">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0"
                        style="background-color: rgb(156, 163, 175);"><svg xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-crown h-6 w-6 text-white" aria-hidden="true">
                            <path
                                d="M11.562 3.266a.5.5 0 0 1 .876 0L15.39 8.87a1 1 0 0 0 1.516.294L21.183 5.5a.5.5 0 0 1 .798.519l-2.834 10.246a1 1 0 0 1-.956.734H5.81a1 1 0 0 1-.957-.734L2.02 6.02a.5.5 0 0 1 .798-.519l4.276 3.664a1 1 0 0 0 1.516-.294z">
                            </path>
                            <path d="M5 21h14"></path>
                        </svg></div>
                </div>

                <!-- CONTENIDO -->
                <div class="flex-grow-1">

                    <h5 class="mb-1 text-dark">Plan Gratuito</h5>

                    <p class="text-muted small mb-4">
                        Actualiza para desbloquear todas las funcionalidades
                    </p>

                    <!-- DETALLES -->
                    <div class="mb-4">

                        <div class="d-flex justify-content-between small mb-2">
                            <span class="text-muted">Vehículos</span>
                            <span class="fw-medium text-dark">0/2</span>
                        </div>

                        <div class="d-flex justify-content-between small mb-2">
                            <span class="text-muted">Documentos por vehículo</span>
                            <span class="fw-medium text-dark">Hasta 5</span>
                        </div>

                        <div class="d-flex justify-content-between small">
                            <span class="text-muted">Historial de mantenimiento</span>
                            <span class="fw-medium text-dark">6 meses</span>
                        </div>

                    </div>

                    <!-- BOTÓN -->
                    <button class="btn w-100 text-white shadow "data-bs-toggle="modal" data-bs-target="#planesModal"
                        style="background:#3178bf;">
                        <i class="bi bi-stars me-2"></i>
                        Mejorar a Premium - S/ 14.99/mes
                    </button>

                </div>

            </div>

        </div>
    @else
        <div class="position-relative p-4 rounded-4 border shadow-sm overflow-hidden"
            style="background: linear-gradient(135deg,#e8f4ff,#f0f9ff); border-color:#3178bf;">

            <!-- ETIQUETA PREMIUM -->
            <div class="position-absolute top-0 end-0 px-3 py-1 text-white small fw-semibold"
                style="background:#3178bf; border-bottom-left-radius:12px;">
                PREMIUM
            </div>

            <div class="d-flex align-items-start gap-3">

                <!-- ICONO -->
                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                    style="width:48px;height:48px;background:#3178bf;">

                    <!-- ICONO CORONA -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                        fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M11.562 3.266a.5.5 0 0 1 .876 0L15.39 8.87a1 1 0 0 0 1.516.294L21.183 5.5a.5.5 0 0 1 .798.519l-2.834 10.246a1 1 0 0 1-.956.734H5.81a1 1 0 0 1-.957-.734L2.02 6.02a.5.5 0 0 1 .798-.519l4.276 3.664a1 1 0 0 0 1.516-.294z">
                        </path>
                        <path d="M5 21h14"></path>
                    </svg>
                </div>

                <!-- CONTENIDO -->
                <div class="flex-grow-1">

                    <h5 class="mb-1 text-dark">Plan Premium</h5>

                    <p class="text-muted small mb-3">
                        Disfruta de todas las funcionalidades ilimitadas
                    </p>

                    <!-- BENEFICIOS -->
                    <div class="mb-3">

                        <div class="d-flex align-items-center mb-2 small text-dark">
                            <i class="bi bi-check2 me-2" style="color:#3178bf;"></i>
                            Vehículos ilimitados
                        </div>

                        <div class="d-flex align-items-center mb-2 small text-dark">
                            <i class="bi bi-check2 me-2" style="color:#3178bf;"></i>
                            Documentos ilimitados
                        </div>

                        <div class="d-flex align-items-center mb-2 small text-dark">
                            <i class="bi bi-check2 me-2" style="color:#3178bf;"></i>
                            Historial completo
                        </div>

                        <div class="d-flex align-items-center small text-dark">
                            <i class="bi bi-check2 me-2" style="color:#3178bf;"></i>
                            Exportar datos
                        </div>

                    </div>

                    <!-- MENSAJE -->
                    <div class="text-center py-2 rounded-3" style="background:#e8f4ff; color:#3178bf;">
                        🎉 Gracias por ser miembro Premium
                    </div>

                </div>
            </div>
        </div>
    @endif
</div>

<div class="modal fade" id="planesModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content rounded-4 border-0">

            <!-- HEADER -->
            <div class="modal-header border-bottom">
                <h5 class="modal-title d-flex align-items-center gap-2">
                    <i class="bi bi-crown-fill fs-4" style="color:#3178bf;"></i>
                    Planes DRIVE UP
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body">

                <div class="row g-4">

                    <!-- PLAN GRATUITO -->
                    <div class="col-md-6">
                        <div class="border rounded-4 p-4 h-100" style="background:#f8f9fa;">

                            <div class="text-center mb-4">
                                <h5 class="mb-2">Plan Gratuito</h5>

                                <div class="d-flex justify-content-center align-items-end gap-1">
                                    <span style="font-size:2.5rem;">S/ 0</span>
                                    <span class="text-muted">/mes</span>
                                </div>

                                <p class="text-muted small mt-2">
                                    Ideal para empezar
                                </p>
                            </div>

                            <ul class="list-unstyled mb-4 small">

                                <li class="d-flex align-items-start mb-2">
                                    <i class="bi bi-check text-success me-2"></i>
                                    Hasta 2 vehículos
                                </li>

                                <li class="d-flex align-items-start mb-2">
                                    <i class="bi bi-check text-success me-2"></i>
                                    5 documentos por vehículo
                                </li>

                                <li class="d-flex align-items-start mb-2">
                                    <i class="bi bi-check text-success me-2"></i>
                                    Historial de 6 meses
                                </li>

                                <li class="d-flex align-items-start mb-2">
                                    <i class="bi bi-check text-success me-2"></i>
                                    Alertas básicas
                                </li>

                                <li class="d-flex align-items-start">
                                    <i class="bi bi-check text-success me-2"></i>
                                    Dashboard básico
                                </li>

                            </ul>

                            <button class="btn btn-secondary w-100" disabled>
                                Plan Actual
                            </button>
                        </div>
                    </div>

                    <!-- PLAN PREMIUM -->
                    <div class="col-md-6">
                        <div class="border rounded-4 p-4 h-100 position-relative"
                            style="border-color:#3178bf;
                             background:linear-gradient(135deg,#f8fbff,#e8f4ff);">

                            <!-- Badge recomendado -->
                            <span class="position-absolute top-0 end-0 px-3 py-1 text-white small fw-semibold"
                                style="background:#3178bf;border-bottom-left-radius:10px;">
                                RECOMENDADO
                            </span>

                            <div class="text-center mb-4 mt-2">
                                <h5 class="mb-2 d-flex justify-content-center align-items-center gap-2">
                                    <i class="bi bi-crown-fill" style="color:#3178bf;"></i>
                                    Plan Premium
                                </h5>

                                <div class="d-flex justify-content-center align-items-end gap-1">
                                    <span style="font-size:2.5rem;">S/ 14.99</span>
                                    <span class="text-muted">/mes</span>
                                </div>

                                <p class="text-muted small mt-2">
                                    Todo lo que necesitas
                                </p>
                            </div>

                            <ul class="list-unstyled mb-4 small">

                                <li class="d-flex mb-2">
                                    <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                    Vehículos ilimitados
                                </li>

                                <li class="d-flex mb-2">
                                    <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                    Documentos ilimitados
                                </li>

                                <li class="d-flex mb-2">
                                    <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                    Historial completo
                                </li>

                                <li class="d-flex mb-2">
                                    <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                    Alertas avanzadas personalizadas
                                </li>

                                <li class="d-flex mb-2">
                                    <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                    Exportar a PDF / Excel
                                </li>

                                <li class="d-flex mb-2">
                                    <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                    Estadísticas avanzadas
                                </li>

                                <li class="d-flex mb-2">
                                    <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                    Soporte prioritario
                                </li>

                                <li class="d-flex">
                                    <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                    Recordatorios por email
                                </li>

                            </ul>
                            <form action="{{ route('user.plan') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn w-100 text-white shadow"
                                    style="background:#3178bf;">
                                    <i class="bi bi-lightning-fill me-2"></i>
                                    Mejorar a Premium
                                </button>
                            </form>

                        </div>
                    </div>

                </div>
            </div>

            <!-- FOOTER -->
            <div class="modal-footer bg-light text-center d-block">
                <small class="text-muted d-block">💳 Aceptamos todos los medios de pago</small>
                <small class="text-muted d-block">🔒 Pago seguro y encriptado</small>
                <small class="text-muted d-block">✨ Cancela cuando quieras, sin compromisos</small>
            </div>

        </div>
    </div>
</div>
