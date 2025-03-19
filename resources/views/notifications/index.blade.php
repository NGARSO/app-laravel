<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary leading-tight animate__animated animate__fadeInDown">
            {{ __('Notifications') }}
        </h2>
    </x-slot>


                <div class="p-6 text-gray-900">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createNotificationModal">
                            <i class="fas fa-plus"></i> Ajouter Notification
                        </button>
                        <span>Annee Scolaire 2024/2025</span>
                    </div>

                    <div class="table-responsive shadow-lg rounded">
                        <table class="table table-striped mt-3 bg-white text-dark animate__animated animate__fadeInUp">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>ID</th>
                                    <th>Message</th>
                                    <th>Destinataire</th>
                                    <th>Date d'envoi</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notifications as $notification)
                                    <tr class="table-row-hover">
                                        <td>{{ $notification->id }}</td>
                                        <td>{{ $notification->message }}</td>
                                        <td>{{ $notification->recipient->name }}</td>
                                        <td>{{ $notification->sent_at }}</td>
                                        <td>
                                            <a href="{{ route('notifications.edit', $notification) }}" class="btn btn-warning btn-sm mr-2">
                                                <i class="fas fa-edit"></i> Modifier
                                            </a>
                                            <form action="{{ route('notifications.destroy', $notification) }}" method="POST" style="display:inline;" onsubmit="return confirm('Voulez-vous vraiment supprimer cette notification ?');">
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
         

    <!-- Modal for Creating a Notification -->
    <div class="modal fade" id="createNotificationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-dark text-white shadow-lg">
                <form action="{{ route('notifications.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter Notification</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control bg-light" id="message" name="message" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="recipient_id">Destinataire</label>
                            <select class="form-control bg-light" id="recipient_id" name="recipient_id" required>
                                @foreach ($recipients as $recipient)
                                    <option value="{{ $recipient->id }}">{{ $recipient->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sent_at">Date d'envoi</label>
                            <input type="datetime-local" class="form-control bg-light" id="sent_at" name="sent_at" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Dependencies and Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
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