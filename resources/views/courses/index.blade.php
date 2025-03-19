<x-app-layout>
    <div class="py-12">
    
                <div class="p-6 text-gray-900">
                  

                    <!-- Bouton Ajouter avec effet -->
                    <button type="button" class="btn btn-custom mb-4 mr-2" data-toggle="modal" data-target="#createCourseModal">
                        <i class="fas fa-plus mr-2"></i> Ajouter Cours
                    </button>

                    <!-- Bouton Imprimer avec effet -->
                    <a class="btn btn-custom mb-4" href="{{ route('/print-courses') }}">
                        <i class="fas fa-file-pdf mr-2"></i> Imprimer la Liste des Cours
                    </a>

                    <!-- Tableau amélioré -->
                    <div class="table-responsive shadow-lg rounded">
                        <table class="table table-striped mt-3 bg-white text-dark animate_animated animate_fadeInUp">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="py-3">ID</th>
                                    <th class="py-3">Nom</th>
                                    <th class="py-3">Description</th>
                                    <th class="py-3">Heure de début</th>
                                    <th class="py-3">Heure de fin</th>
                                    <th class="py-3">Salle</th>
                                    <th class="py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr class="table-row-hover">
                                        <td>{{ $course->id }}</td>
                                        <td>{{ $course->name }}</td>
                                        <td>{{ $course->description }}</td>
                                        <td>{{ $course->start_time }}</td>
                                        <td>{{ $course->end_time }}</td>
                                        <td>{{ $course->room->label }}</td>
                                        <td>
                                            <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning btn-sm mr-2">
                                                <i class="fas fa-edit"></i> Modifier
                                            </a>
                                            <form action="{{ route('courses.destroy', $course) }}" method="POST" style="display:inline;" onsubmit="return confirm('Voulez-vous vraiment supprimer ce cours ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour créer un cours -->
    <div class="modal fade" id="createCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-dark text-white shadow-lg">
                <form action="{{ route('courses.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter Cours</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control bg-light" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control bg-light" id="description" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="start_time">Heure de début</label>
                            <input type="time" class="form-control bg-light" id="start_time" name="start_time" required>
                        </div>
                        <div class="form-group">
                            <label for="end_time">Heure de fin</label>
                            <input type="time" class="form-control bg-light" id="end_time" name="end_time" required>
                        </div>
                        <div class="form-group">
                            <label for="room_id">Salle</label>
                            <select class="form-control bg-light" id="room_id" name="room_id" required>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-custom">Ajouter</button>
                    </div>
                </form>
         
    </div>

    <!-- Dépendances et styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
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