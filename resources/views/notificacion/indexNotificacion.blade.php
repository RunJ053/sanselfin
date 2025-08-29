@extends('layouts.notificacion.notificacionLayout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-90 to-gray-100">
    <div class="container mx-auto p-6 max-w-4xl">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-4xl font-bold text-gray-800 mb-2">Mis Notificaciones</h2>
            <div class="h-1 w-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full"></div>
        </div>

        @if($notificaciones->count() > 0)
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

            <!-- Lista de notificaciones -->
            <div class="space-y-4">
                @foreach($notificaciones as $noti)
                    <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 {{ $noti->leida ? 'bg-gray-50 border-l-4 border-gray-300' : 'bg-white border-l-4 border-gradient-to-b from-blue-500 to-purple-600' }}">
                        <!-- Indicador visual para no leídas -->
                        @if(!$noti->leida)
                            <div class="absolute top-4 right-4">
                                <div class="w-3 h-3 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full animate-pulse"></div>
                            </div>
                        @endif

                        <div class="p-6">
                            <div class="flex items-start justify-between">
                                <div class="flex-1 pr-4">
                                    <!-- Título con icono -->
                                    <div class="flex items-center mb-3">
                                        <div class="p-2 {{ $noti->leida ? 'bg-gray-200' : 'bg-gradient-to-r from-blue-100 to-purple-100' }} rounded-lg mr-3">
                                            @if(!$noti->leida)
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V7a2 2 0 012-2h2a2 2 0 012 2v12"></path>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            @endif
                                        </div>
                                        <h3 class="font-bold text-xl {{ $noti->leida ? 'text-gray-700' : 'text-gray-900' }}">
                                            {{ $noti->titulo }}
                                        </h3>
                                    </div>
                                    
                                    <!-- Mensaje -->
                                    <p class="{{ $noti->leida ? 'text-gray-600' : 'text-gray-700' }} text-base leading-relaxed mb-4">
                                        {{ $noti->mensaje }}
                                    </p>
                                    
                                    <!-- Fecha con icono -->
                                    <div class="flex items-center text-sm {{ $noti->leida ? 'text-gray-500' : 'text-gray-600' }}">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $noti->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>

                            <!-- Botón de acción -->
                            @if(!$noti->leida)
                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <form action="{{ route('notificaciones.leida', $noti->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="group/btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-medium rounded-lg transition-all duration-200 transform hover:scale-105 hover:shadow-lg">
                                            <svg class="w-4 h-4 mr-2 group-hover/btn:rotate-12 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Marcar como leída
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Estado vacío mejorado -->
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
@endsection