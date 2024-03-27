@extends('backend.dashboard.layout')
@section('backend')

    <div class="page-content">
        @include('backend.dashboard.component.breadcrumb', ['title' => $config['seo'][$config['method']]['title']])
        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
            
                        <h6 class="card-title" style="font-weight: bolder;color:gold">{{__('messages.generalTitle')}}</h6>
                        <form action="{{route('post.catalogue.destroy', $postCatalogue->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="row">
                                    <div class="mb-3">
                                        <label class="form-label">{{__('messages.generalName')}} <span class="text-danger">(*)</span></label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ old('name', $postCatalogue->name ?? '') }}" placeholder="" readonly>
                                    </div>
                            <button type="submit" name="send" value="send" class="btn btn-danger submit">{{__('messages.deleteButton')}}</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
   
@endsection
