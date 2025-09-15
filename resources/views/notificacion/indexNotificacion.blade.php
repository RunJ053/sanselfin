@extends('layouts.notificacion.notificacionLayout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-90 to-gray-100">
    <div class="container mx-auto p-6 max-w-4xl">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-4xl font-bold text-gray-800 mb-2">Mis Notificaciones</h2>
            <div class="h-1 w-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full"></div>
        </div>

        @if($notificaciones->count() > 0 ?? $notificaciones == null)
        <!-- Estadísticas rápidas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white rounded-xl p-4 shadow-lg border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V7a2 2 0 012-2h2a2 2 0 012 2v12"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-bold text-gray-800">{{ $notificaciones->count() }}</p>
                        <p class="text-gray-600 text-sm">Total</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-4 shadow-lg border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-bold text-gray-800">{{ $notificaciones->where('leida', true)->count() }}</p>
                        <p class="text-gray-600 text-sm">Leídas</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-4 shadow-lg border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-orange-100 rounded-full">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-bold text-gray-800">{{ $notificaciones->where('leida', false)->count() }}</p>
                        <p class="text-gray-600 text-sm">Pendientes</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones de acciones mejorados -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div class="flex flex-wrap gap-3">
                <!-- Marcar todas como leídas -->
                <form action="{{ route('notificaciones.marcarTodasLeidas') }}" method="POST" class="inline-block">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-200">
                        Marcar todas leídas
                    </button>
                </form>

                <!-- Eliminar todas -->
                <form action="{{ route('notificaciones.eliminarTodas') }}" method="POST"
                    onsubmit="return confirm('¿Seguro que deseas eliminar TODAS las notificaciones?')" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200">
                        Eliminar todas
                    </button>
                </form>
            </div>
        </div>

        <!-- Lista de notificaciones con checkboxes -->
        <form action="{{ route('notificaciones.eliminarSeleccionadas') }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="space-y-4">
                @foreach($notificaciones as $noti)
                <div class="group relative overflow-hidden rounded-xl shadow-lg transition-all duration-300 flex items-start gap-4 p-6
                            {{ $noti->leida ? 'bg-gray-50 border-l-4 border-gray-300' : 'bg-white border-l-4 border-gradient-to-b from-blue-500 to-purple-600' }}">
                    <!-- Contenido -->
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <h3 class="font-bold text-xl {{ $noti->leida ? 'text-gray-700' : 'text-gray-900' }}">
                                {{ $noti->titulo }}
                            </h3>
                            <div class="flex items-center gap-2">
                                <small class="text-gray-500">{{ $noti->created_at->diffForHumans() }}</small>
                                <!-- Eliminar individual -->
                                <form action="{{ route('notificaciones.destroy', $noti->id) }}" method="POST"
                                    onsubmit="return confirm('¿Seguro que deseas eliminar esta notificación?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1 text-gray-400 hover:text-red-600 transition-colors duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <p class="{{ $noti->leida ? 'text-gray-600' : 'text-gray-700' }} text-base leading-relaxed mt-2">
                            {{ $noti->mensaje }}
                        </p>

                        <!-- Botón marcar como leída -->
                        @if(!$noti->leida)
                        <div class="mt-4">
                            <form action="{{ route('notificaciones.leida', $noti->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-3 py-1 bg-blue-500 text-white text-sm rounded-lg hover:bg-blue-600 transition-colors duration-200">
                                    Marcar como leída
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </form>
        @else
        <!-- Estado vacío -->
        <div class="text-center py-16">
            <div class="max-w-md mx-auto">
                <div class="mb-8">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-blue-100 to-purple-100 rounded-full mb-6">
                        <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-5 5v-5z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V7a2 2 0 012-2h2a2 2 0 012 2v12"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">¡Todo al día!</h3>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        No tienes notificaciones pendientes en este momento. Te mantendremos informado cuando llegue algo nuevo.
                    </p>
                </div>

                <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-6 border border-blue-100">
                    <p class="text-sm text-gray-600">
                        Las notificaciones aparecerán aquí automáticamente cuando tengas actualizaciones importantes.
                    </p>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>