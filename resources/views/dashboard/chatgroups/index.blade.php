@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Groupes de discussion</h1>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success col-lg-12" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between mb-3">
            <div class="d-flex"></div>
            <div style="margin: 10px !important;">
                <a href="/dashboard/chatgroups/create" class='btn btn-primary mb-3'><i class="bi me-2 bi-plus"></i>Ajouter un nouveau groupe de discussion</a>
            </div>
        </div>

        @if($chatGroups->count())
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Catégorie</th>
                            <th scope="col">Lien</th>
                            <th scope="col">Description</th>
                            <th scope="col">Membres</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($chatGroups as $chatGroup)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $chatGroup->name }}</td>
                                <td>{{ $chatGroup->category->name }}</td>
                                <td>{{ $chatGroup->link }}</td>
                                <td>{{ $chatGroup->description }}</td>
                                <td>

                                    @foreach($chatGroup->members as $member)
                                        {{ $member->user->name }}
                                        @if(!$loop->last), @endif
                                    @endforeach
                                </td>
                                <td class="d-flex ">
                                    <a href="/dashboard/chatgroups/{{ $chatGroup->id }}/edit">
                                        <button type="button" class="btn-sm btn-primary"><i class="bi bi-pencil-square"></i></button>
                                    </a>
                                    <form action="/dashboard/chatgroups/{{ $chatGroup->id }}" method="post" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce groupe de discussion ?')">
                                        @method('delete')
                                        @csrf
                                        <button class="btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $chatGroups->links() }}
                </div>
            </div>
        @else
            <div class="alert alert-info">
                Aucun groupe de discussion disponible.
            </div>
        @endif
    </div>
@endsection
