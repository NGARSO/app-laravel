<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary leading-tight animate_animated animate_fadeInDown">
            {{ __('Liste des Cours') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Tableau amélioré -->
                    <div class="table-responsive shadow-lg rounded">
                        <table class="table table-striped mt-3 bg-white text-dark animate_animated animate_fadeInUp">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="py-3">ID</th>
                                    <th class="py-3">Nom</th>
                                    <th class="py-3">Nombre d'Étudiants</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr class="table-row-hover">
                                        <td>{{ $course->id }}</td>
                                        <td>{{ $course->name }}</td>
                                        <td>{{ $course->students_count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dépendances -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        .btn-custom {
            background: #00b4d8;
            color: #fff;
            padding: 10px 25px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 180, 216, 0.4);
            color: #fff;
        }

        .table-row-hover:hover {
            background: rgba(0, 123, 255, 0.1);
            transition: background 0.3s ease;
        }

        .modal-content {
            border: none;
            border-radius: 15px;
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
        }
    </style>
</x-app-layout>