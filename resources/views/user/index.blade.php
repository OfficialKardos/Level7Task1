@extends('layout')

@section('content')
    <div class="container">
        <h1 class="my-4">Users</h1>

        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add User</a>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editModal" 
                                    data-id="{{ $user->id }}" 
                                    data-first_name="{{ $user->first_name }}" 
                                    data-last_name="{{ $user->last_name }}" 
                                    data-email="{{ $user->email }}" 
                                    data-phone_number="{{ $user->phone_number }}">Edit</button>
                        
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            <
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No users found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="edit_first_name" name="first_name">
                        </div>
                        <div class="mb-3">
                            <label for="edit_last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="edit_last_name" name="last_name">
                        </div>
                        <div class="mb-3">
                            <label for="edit_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="edit_phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="edit_phone_number" name="phone_number">
                        </div>
                        <div class="mb-3">
                            <label for="edit_password" class="form-label">Password (optional)</label>
                            <input type="password" class="form-control" id="edit_password" name="edit_password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editModal = document.getElementById('editModal');
            editModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');
                var firstName = button.getAttribute('data-first_name');
                var lastName = button.getAttribute('data-last_name');
                var email = button.getAttribute('data-email');
                var phoneNumber = button.getAttribute('data-phone_number');

                var modalTitle = editModal.querySelector('.modal-title');
                var form = editModal.querySelector('form');
                var firstNameInput = editModal.querySelector('#edit_first_name');
                var lastNameInput = editModal.querySelector('#edit_last_name');
                var emailInput = editModal.querySelector('#edit_email');
                var phoneNumberInput = editModal.querySelector('#edit_phone_number');

                modalTitle.textContent = 'Edit User ' + id;
                firstNameInput.value = firstName;
                lastNameInput.value = lastName;
                emailInput.value = email;
                phoneNumberInput.value = phoneNumber;

                form.setAttribute('action', '/users/' + id);
            });
        });
    </script>
@endsection
