@extends('admins.contacts.master')


@section('title')
    {{ $contact->subject }}
@endsection

@section('content-mail')
  <div class="col-md-9">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title">Liên hệ chi tiết</h3>

        <div class="card-tools">
          {{-- <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Previous"><i class="fas fa-chevron-left"></i></a>
          <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Next"><i class="fas fa-chevron-right"></i></a> --}}
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="mailbox-read-info">
          <h5>{{ $contact->subject }}</h5>
          <h6>From: {{ $contact->email }}
            <span class="mailbox-read-time float-right">{{ $contact->toDayDateTimeString() }}</span></h6>
        </div>
        <!-- /.mailbox-read-info -->
        <div class="mailbox-controls with-border">
          <div class="btn-group">
            <button type="submit" form="destroy" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete">
              <i class="far fa-trash-alt"></i></button>
            <a href="{{ route('admin.contacts.reply', $contact->id) }}" type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Trả lời">
              <i class="fas fa-reply"></i></a>
            <a href="{{ route('admin.contacts.forward', $contact->id) }}" type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Chuyển tiếp">
              <i class="fas fa-share"></i></a>
          </div>
          <!-- /.btn-group -->
    
        </div>
        <!-- /.mailbox-controls -->
        <div class="mailbox-read-message">
          {!! $contact->description !!}
        </div>
        <!-- /.mailbox-read-message -->
      </div>
      <!-- /.card-body -->
      <!-- /.card-footer -->
      <div class="card-footer">
        <div class="float-right">
          <a href="{{ route('admin.contacts.reply', $contact->id) }}" type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Trả lời">
            <i class="fas fa-reply"></i> Trả lời</a>
          <a href="{{ route('admin.contacts.forward', $contact->id) }}" type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Chuyển tiếp">
            <i class="fas fa-share"></i> Chuyển tiếp</a>
        </div>
        <form id="destroy" onclick="return confirm('Bạn chắc chắn muốn xoá?')" action="{{ route('admin.contacts.destroy', $contact->id) }}" method="post" class="d-inline-block mb-0">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-default"><i class="far fa-trash-alt"></i> Delete</button>
        </form>
      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->
  </div>   
@endsection