@extends('templates/template_forms')

@section('contenu')
<br>
<div class="col-md-6 offset-md-3">
    <div class="card">
        <div class="card-body">
            <form
                method="POST"
                action="{{ url('story') }}"
                accept-charset="UTF-8"
            >
                @csrf
                <div class="mb-3">
                    <input
                        class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                        placeholder="titre de l'histoire"
                        name="title"
                        type="text"
                        value="{{ old('title') }}"
                    >
                    {!! $errors->first(
                        'title',
                        '<div class="invalid-feedback">:message</div>'
                    ) !!}
                </div>
                <div class="mb-3">
                    <input class="form-control {{ $errors->has('summary') ? 'is-invalid' : '' }}"
                           placeholder="Resumé de l'histoire"
                           name="summary"
                           type="text"
                           value="{{ old('summary') }}"
                    >
                    {!! $errors->first(
                        'summary',
                        '<div class="invalid-feedback">:message</div>'
                        ) !!}
                </div>
                <div class="mb-3">
                    <textarea class="form-control {{ $errors->has('author') ? 'is-invalid' : '' }}"
                              placeholder="Auteur"
                              name="author"
                              rows="4"
                    >{{ old('author') }}</textarea>
                    {!! $errors->first(
                        'author',
                        '<div class="invalid-feedback">:message</div>'
                        ) !!}
                </div>
                <button class="btn btn-info float-end" type="submit">Envoyer !</button>
            </form>
        </div>
    </div>
</div>
@endsection