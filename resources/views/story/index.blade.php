@extends('template')

@section('titre')
	Liste des inscriptions à la newsletter
@endsection

@section('templates/template_forms')
	@if (session('success'))
		<div class="alert alert-success">
			{{ session('success') }}
		</div>
	@endif

	<h2>Liste des abonnés</h2>

	<table class="table table-striped">
		<thead>
			<tr>
				<th>N°</th>
				<th>Email</th>
				<th>Date d&apos;inscription</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($newsletters as $newsletter)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $newsletter->email }}</td>
					<td>{{ $newsletter->created_at->format('d/m/Y H:i') }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<a href="{{ route('newsletters.createView') }}" class="btn btn-primary">
		Ajouter une adresse
	</a>
@endsection