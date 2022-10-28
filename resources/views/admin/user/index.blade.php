@extends('admin.layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex w-100 justify-content-between">
                    <div class="me-2">
                        <h6 class="mb-0">Total user : </h6>
                    </div>
                    <h5 class="fw-semibold mb-0">{{ $total_users }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-lg rounded card">
    <div class="card-header" id="#atas">
        @include('sweetalert::alert')
    </div>
    <div class="table-responsive text-nowrap">
        <div class="container">
            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Saldo</th>
                        <th>Score</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if (count($users))
                    @foreach ($users as $user)
                    <tr>
                        <td>
                            <div class="d-flex">
                                {{ $loop->iteration }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $user->name }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $user->email }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                RP. {{ number_format($user->saldo, 0, ',', '.') }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $user->score }} Poin
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $user->role }}
                            </div>
                        </td>
                        <td>
                            <form action="{{ route('user.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalCenter"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg> Hapus
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCenterTitle">Apakah Anda Yakin?
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Kembali
                                                </button>
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="3">
                            <div class='alert alert-primary text-center'>
                                Tidak ada data
                            </div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection