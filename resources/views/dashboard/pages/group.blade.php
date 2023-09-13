@extends('welcome')

@section('container')
    <div class="container">

        <div class=" container mt-5">
            <div  class="h-100 position-relative" >

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <a href="/" class="text-white"><i class="bi bi-arrow-left"></i></a>
                       Discussion : {{ $group->name }}</div>
                    <div class="card-body" id="chat-messages" style="max-height: 400px; overflow-y: scroll;">
                        <div>
                            @include('dashboard.pages.messages')
                        </div>
                    </div>
                    <div class="card-footer">
                        <form action="{{ $group->id }}/store" method="post">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="prompt" placeholder="Tapez votre message">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>


        </div>





    </div>
@endsection


