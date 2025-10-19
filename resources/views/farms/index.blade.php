@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Farm List</h5>
    <button class="btn btn-sm btn-primary" id="addFarmBtn">+ Add Farm</button>
  </div>
  <div class="card-body">
    <table class="table table-bordered align-middle">
      <thead class="table-light">
        <tr>
          <th width="5%">#</th>
          <th>Name</th>
          <th>Owner</th>
          <th>Address</th>
          <th width="15%">Action</th>
        </tr>
      </thead>
      <tbody id="farmTableBody">
        @foreach($farms as $i => $f)
          <tr data-id="{{ $f->id }}">
            <td>{{ $i + 1 }}</td>
            <td class="name">{{ $f->name }}</td>
            <td class="owner">{{ $f->owner }}</td>
            <td class="address">{{ $f->address }}</td>
            <td>
              <button class="btn btn-sm btn-warning editFarm">Edit</button>
              <button class="btn btn-sm btn-danger deleteFarm">Delete</button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@include('components.modal_farm')
@endsection

@section('scripts')
<script>
$(function() {
  const modal = new bootstrap.Modal('#farmModal');

  $('#addFarmBtn').click(function() {
    $('#farmForm')[0].reset();
    $('#farm_id').val('');
    modal.show();
  });

  $('#farmForm').submit(function(e) {
    e.preventDefault();

    const id = $('#farm_id').val();
    const url = id ? `/farms/${id}` : '/farms';
    const data = {
      name: $('#name').val(),
      owner: $('#owner').val(),
      address: $('#address').val(),
      _token: '{{ csrf_token() }}'
    };

    if (id) data._method = 'PUT';

    $.ajax({
      url: url,
      method: 'POST', 
      data: data,
      success: function() {
        location.reload();
      },
      error: function(xhr) {
        alert('Error: ' + (xhr.responseJSON?.message || 'Something went wrong'));
      }
    });
  });

  $('.editFarm').click(function() {
    const tr = $(this).closest('tr');
    $('#farm_id').val(tr.data('id'));
    $('#name').val(tr.find('.name').text());
    $('#owner').val(tr.find('.owner').text());
    $('#address').val(tr.find('.address').text());
    modal.show();
  });

  $('.deleteFarm').click(function() {
    if (!confirm('Are you sure want to delete this farm?')) return;
    const id = $(this).closest('tr').data('id');

    $.ajax({
      url: `/farms/${id}`,
      method: 'POST',
      data: { _method: 'DELETE', _token: '{{ csrf_token() }}' },
      success: function() {
        location.reload();
      },
      error: function() {
        alert('Failed to delete');
      }
    });
  });
});
</script>
@endsection