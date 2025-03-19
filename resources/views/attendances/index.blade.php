<x-app-layout>
    <div class="py-12">
  
                <div class="p-6 text-gray-900">
                   

                    <!-- Bouton Ajouter avec effet -->
                    <button type="button" class="btn btn-custom mb-4" data-toggle="modal" data-target="#createAttendanceModal">
                        <i class="fas fa-plus mr-2"></i> Ajouter Présence
                    </button>

                    <!-- Tableau amélioré -->
                    <div class="table-responsive shadow-lg rounded">
                        <table class="table table-striped mt-3 bg-white text-dark animate_animated animate_fadeInUp">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="py-3">ID</th>
                                    <th class="py-3">Date</th>
                                    <th class="py-3">Statut</th>
                                    <th class="py-3">Professeur</th>
                                    <th class="py-3">Cours</th>
                                    <th class="py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendances as $attendance)
                                    <tr class="table-row-hover">
                                        <td>{{ $attendance->id }}</td>
                                        <td>{{ $attendance->date }}</td>
                                        <td>{{ $attendance->status }}</td>
                                        <td>{{ $attendance->professor->name }}</td>
                                        <td>{{ $attendance->course->name }}</td>
                                        <td>
                                            <a href="{{ route('attendances.edit', $attendance) }}" class="btn btn-warning btn-sm mr-2">
                                                <i class="fas fa-edit"></i> Modifier
                                            </a>
                                            <form action="{{ route('attendances.destroy', $attendance) }}" method="POST" style="display:inline;" onsubmit="return confirm('Voulez-vous vraiment supprimer cette présence ?');">
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

    <!-- Modal pour créer une présence -->
    <div class="modal fade" id="createAttendanceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-dark text-white shadow-lg">
                <form action="{{ route('attendances.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter Présence</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control bg-light" id="date" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Statut</label>
                            <select class="form-control bg-light" id="status" name="status" required>
                                <option value="present">Présent</option>
                                <option value="absent">Absent</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="professor_id">Professeur</label>
                            <select class="form-control bg-light" id="professor_id" name="professor_id" required>
                                @foreach ($professors as $professor)
                                    <option value="{{ $professor->id }}">{{ $professor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="course_id">Cours</label>
                            <select class="form-control bg-light" id="course_id" name="course_id" required>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
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
        </div>
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