@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <h1 class="display-5">Manage Contacts</h1>
                <p class="lead">Add or remove contacts.</p>
                <form action="contacts" method="post">
                    @csrf
    {{--                <div class="mt-3 mb-4">--}}
                        <Label for="email" class="mb-1">Add a New Contact</Label>
                        <input type="email" class="form-control mb-3" name="email" placeholder="Email address" required>
                        <button type="submit" class="btn btn-primary">Add Contact</button>
    {{--                </div>--}}
                </form>
                <h2 class="mt-5 display-7">Contacts list</h2>
                <table class="table mt-3 text-center">
                    <thead>
                        <tr>
{{--                            <th scope="col">Selection</th>--}}
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if (count($contacts) > 0)
                        @foreach ($contacts as $contact)
                            <tr>
{{--                                <td><input type="checkbox" name="id" form="removeSelectedIds" class="selection align-middle" value="{{ $contact->id }}"></td>--}}
                                <td class="align-middle">{{ $contact->contact_email }}</td>
                                <td><form action="{{ route('contact.destroy', $contact) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" title="Remove">Remove</button>
                                    </form></td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3"><i>No saved contacts.</i></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
{{--                <form id="removeSelectedIds" action="{{ route('contact.destroyAll', $contacts) }}" method="POST">--}}
{{--                    @csrf--}}
{{--                    @method('DELETE')--}}
{{--                    <button class="btn btn-danger" title="Remove" form="removeSelectedIds">Remove Selected</button>--}}
{{--                </form>--}}
            </div>
        </div>
    </div>
@endsection
