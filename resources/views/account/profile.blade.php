@extends('layouts.main')
@section('title')
    @parent Профиль
@endsection
@section('header')
@endsection
@section('content')
    <section class="profile ">
        @include('inc.message')
            <div class="details m-2">
                <img src="@if(Auth::user()->avatar){!!Auth::user()->avatar!!}@else{!! asset('images/default_avatar.png') !!}@endif" class="profile-pic" height="150" width="150">
                <p class="heading">{{Auth::user()->name}}
                    <span class="text-decoration-none text-secondary" user="{{ Auth::user()->id }}" onclick="PrivateHandle(this)">
                        @if(Auth::user()->is_private)
                            <i class="fa-solid fa-lock"></i>
                        @else
                            <i class="fa-solid fa-lock-open"></i>
                        @endif
                    </span>
                </p>
                <div class="location">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12 ,2Z"></path>
                    </svg>
                    <p>Россия</p>
                </div>
                <div class="stats">
                    <a href="{{ route('account.places', 'liked') }}" class="col-4 text-decoration-none  @if(count($likes) === 0) disabled @endif">
                        <h4>{{ count($likes) }}</h4>
                        <p class="fs-3">
                            <i class="fa-solid fa-thumbs-up"></i>
                        </p>
                    </a>
                    <a  class="col-4 text-decoration-none @if(count($favorites) === 0){{'disabled'}}@endif" href="{{ route('account.places', 'favorite') }}">
                        <h4>{{ count($favorites) }}</h4>
                        <p class="fs-3">
                            <i class="fa-star fa-solid"></i>
                        </p>
                    </a>
                    <a  class="col-4 text-decoration-none @if(count($created) === 0){{'disabled'}}@endif" href="{{ route('account.places', 'created') }}">
                        <h4>{{ count($created) }}</h4>
                        <p class="fs-3">
                            <i class="fa-solid fa-map-location-dot"></i>
                        </p>
                    </a>
                    <a class="col-4 text-decoration-none text-light" href="{{ route('show::routes') }}">
                        <h4>Маршруты</h4>
                        <p class="fs-3">
                            <i class="fa-solid fa-map-location-dot"></i>
                        </p>
                    </a>
                </div>
                <form class="d-flex align-items-center flex-column" method="get" action="{{ route('app::parse', ['count' => 10]) }}">
                    @csrf
                    <div class="d-inline-flex gap-1 align-items-center justify-content-evenly">
                        <select name="source-id" class="form-select flex-fill h-auto">
                            @foreach($sources as $source)
                                    <option value="{{ $source->id }}">{{ $source->title . ': уже получено - ' .  $source->total_parsed_items}}</option>
                            @endforeach
                        </select>
                        <input name="count" type="text" class="form-control h-auto"  placeholder="введите количество" value="{{ old('count') }}">

                    </div>
                    <button type="submit" class="btn btn-sm btn-outline-success h-100">Спарсить</button>
                </form>
                <div class="d-flex justify-content-center flex-column align-items-center">
                    <a class="btn" href="{{ route('profile.show', [Auth::user()->slug]) }}"> Мой публичный профиль</a>
                    <span>Поделиться</span>
                    <div class="d-flex">

                        <!-- Button trigger modal -->
                        <span class="btn-sm btn-outline-secondary text-decoration-none fs-3" data-bs-toggle="modal" data-bs-target="#sendEmailModal" >
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <a class="btn-sm btn-outline-secondary text-decoration-none fs-3 disabled" href="{{ route('profile.show', [Auth::user()->slug]) }}">
                            <i class="fa-brands fa-vk"></i>
                        </a>
                    </div>
                </div>
            </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="sendEmailModal" tabindex="-1" aria-labelledby="sendEmailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sendEmailModalLabel">Поделиться профилем</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="was-validated" method="post" action="{{ route('account.message.store') }}">
                        @csrf
                        <input hidden type="text" class="" name="from_user_id" required value="{{ Auth::user()->id }}"
                        >
                        <input hidden type="text" class="" name="link" value="{{ Auth::user()->public_link }}"
                        >
                        <div>

                            <label for="validationCustomEmail" class="form-label">Email получателя</label>
                            <input type="email" class="form-control" id="validationCustomEmail" name="recipient_email" required
                                   oninput="validate()">
                            <div class="valid-feedback">
                                Отлично!
                            </div>
                            <div class="invalid-feedback">
                                Пожалуйста, укажите свою почту
                            </div>
                        </div>
                        <div>
                            <label for="validationCustomMessage" class="form-label">Сообщение</label>
                            <textarea class="form-control" id="validationCustomMessage" required
                                      style="resize: none;"
                                      name="message" rows="6"
                                      oninput="validate()"
                                      minlength="10" maxlength="500"
                            ></textarea>
                            <div class="valid-feedback">
                                Отлично!
                            </div>
                            <div class="invalid-feedback">
                                Пожалуйста, напишите сообщение
                            </div>
                        </div>
                        <button id="send-button" class="btn btn-primary disabled" type="submit" >Отправить</button>
                    </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>


        function validate() {
            let email = document.getElementById('validationCustomEmail');
            let message = document.getElementById('validationCustomMessage');
            const sendButton = document.getElementById('send-button');
            if ((email.value.match(/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/))
            && (message.value.length >= 10 && message.value.length <= 500)){
                sendButton.classList.remove('disabled');
            } else {
                sendButton.classList.add('disabled');
            }
        }

        let modalMessage = document.getElementById('modalMessage');
        modalMessage.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            let button = event.relatedTarget;
            // Extract info from data-bs-* attributes
            let senderEmail = button.getAttribute('data-bs-email')

            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            let modalEmail = modalMessage.querySelector('#validationCustomEmail')

            modalEmail.value = senderEmail;
        });
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            let forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('click', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })();

        // function sendMessage() {
        //     sendButton.innerHTML = '<div class="spinner-border" role="status"></div>';
        //     const comment = [];
        //     comment['sender_email'] = email.value;
        //     comment['sender_name'] = name.value;
        //     comment['message'] = message.value;
        //     send('/comment/quick/').then((result) => {
        //             console.log(result)
        //         });
        //
        // }
        // async function send(url){
        //     const comment = [];
        //     comment['sender_email'] = email.value;
        //     comment['sender_name'] = name.value;
        //     comment['message'] = message.value;
        //     console.log(comment, 'hello', )
        //     let user = {
        //         name: 'John',
        //         surname: 'Smith'
        //     };
        //
        //     let response = await fetch(url, {
        //         method: 'PUT',
        //         headers: {
        //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
        //                 .getAttribute('content'),
        //             'Content-Type': 'application/json; charset=utf-8'
        //         },
        //         body: JSON.stringify(user),
        //     });
        //     return await response.json();
        // }
    </script>
@endpush

@once
    @push('js')
        <script src="{{ asset('js/PrivateHandle.js')}}"></script>
    @endpush
@endonce

