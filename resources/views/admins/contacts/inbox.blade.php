@extends('admins.contacts.master');
@section('title')
    Hộp thư đến
@endsection
@section('content-mail')

    <!-- /.col -->
    <div class="col-md-9">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">Thư đến</h3>
          <div class="card-tools">
            <div class="input-group input-group-sm">
              <input type="text" class="form-control" placeholder="Tìm kiếm">
              <div class="input-group-append">
                <div class="btn btn-primary">
                  <i class="fas fa-search"></i>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <div class="mailbox-controls">
            <!-- Check all button -->
            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
            </button>
            <div class="btn-group">
              <button type="submit" form="massDestroy" class="btn btn-default btn-sm"><i class="far fa-trash-alt"></i></button>
            </div>
            <!-- /.btn-group -->
            <button type="button" class="btn btn-default btn-sm reload"><i class="fas fa-sync-alt"></i></button>
            <div class="float-right">
              <div class="btn-group">
                  <div class="btn-group">
                      {{ $contacts->links() }}
                  </div>
              </div>
              <!-- /.btn-group -->
            </div>
            <!-- /.float-right -->
          </div>
          <div class="table-responsive mailbox-messages">
            <table class="table table-hover">
              <tbody>
                @foreach ($contacts as $contact)
                <tr class="@if($contact->isRead()) bg-white @else bg-light @endif">
                  <td>
                    <div class="icheck-primary">
                      <input form="massDestroy" type="checkbox" value="{{ $contact->id }}" name="ids[]" multiple id="check{{ $contact->id }}">
                      <label for="check{{ $contact->id }}"></label>
                    </div>
                  </td>
                  <td class="mailbox-star"><a href="#" data-number="{{ $contact->id }}" class="text text-muted " ><i data-number="{{ $contact->id }}" class="fas fa-star @if($contact->isStar())text-warning @endif"></i></a></td>

                  <td class="mailbox-name"><a href="{{ route('admin.contacts.show', $contact->id) }}">{{ $contact->name }}</a></td>
                  <td class="mailbox-subject"><b><a href="{{ route('admin.contacts.show', $contact->id) }}">{{ $contact->subject }}</b></a> - {{ $contact->limitDescription() }}
                  </td>
                  <td class="mailbox-attachment"></td>
                  <td class="mailbox-date">{{ $contact->diffFromNow() }}</td>
                </tr>
                @endforeach

              </tbody>
            </table>
            <!-- /.table -->
          </div>
          <!-- /.mail-box-messages -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer p-0">
          <div class="mailbox-controls">
            <!-- Check all button -->
            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
            </button>
            <form action="{{ route('admin.contacts.massDestroy') }}" class="btn-group d-inline-block mb-0" id="massDestroy" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-default btn-sm"><i class="far fa-trash-alt"></i></button>
            </form>
            <!-- /.btn-group -->
            <button type="button" class="btn btn-default btn-sm reload"><i class="fas fa-sync-alt"></i></button>
            <div class="float-right">
              <div class="btn-group">
                  {{ $contacts->links() }}
              </div>
              <!-- /.btn-group -->
            </div>
            <!-- /.float-right -->
          </div>
        </div>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->

@endsection