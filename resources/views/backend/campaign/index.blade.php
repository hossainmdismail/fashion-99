@extends('backend.master')
@section('content')
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Campaign List </h2>
                {{-- <p>Here Your All Catego.</p> --}}
            </div>
            <div>
                <input type="text" placeholder="Search order ID" class="form-control bg-white">
            </div>
        </div>
        <div class="card mb-4">
            <header class="card-header">
                <div class="row gx-3">
                    <div class="col-lg-2 col-6 col-md-3">
                        <a href="{{ route('campaign.create') }}" class="btn btn-primary">Create</a>
                    </div>
                </div>
            </header> <!-- card-header end// -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Campaign For</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Target price</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Start</th>
                                <th scope="col">End</th>
                                <th scope="col" class="text-end"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $key => $request)
                                <tr>
                                    <td><b>{{ $request->campaign_for }}</b></td>
                                    <td>
                                        <img style="width: 50px"
                                            src="{{ asset('files/campaign/' . $request->campaign_image) }}" alt="">
                                    </td>
                                    <td><b>{{ $request->campaign_name }}</b></td>
                                    <td><b>{{ $request->target }}</b></td>
                                    <td><b>{{ $request->s_price }} {{ $request->sp_type == 'Percent' ? '%' : '' }}</b></td>
                                    <td><b>{{ $request->getStart() }}</b></td>
                                    <td><b>{{ $request->getEnd() }}</b></td>
                                    <form action="{{ route('campaign.destroy', $request->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <td class="text-end">
                                            <a href="{{ route('campaign.edit', $request->id) }}"
                                                class="btn btn-md rounded font-sm">Edit</a>
                                            @if (Auth::guard('admin')->user()->role == 'superAdmin')
                                                <button type="submit"
                                                    class="btn btn-md bg-warning rounded font-sm">Delete</button>
                                            @endif
                                        </td>
                                    </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- table-responsive //end -->
            </div> <!-- card-body end// -->
        </div> <!-- card end// -->
    </section> <!-- content-main end// -->
@endsection
