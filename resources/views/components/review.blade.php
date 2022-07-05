<!-- Карточка отзыва -->
@forelse($comments as $comment)
    @if($comment->status->title !== 'active')
        @continue
    @else
        <section class='review_card'>
            <div class="review_card_box">
                <div class="review_inner flex-grow-1">
                    <div class="review_body">
                        <div class="review_head">

                            <h3>{{ Str::ucfirst($comment->user->name) }} @if($comment->user == Auth::user())(это Вы)@endif</h3>
                            <small>{{ date('d-m-Y', strtotime($comment->updated_at)) }}</small>
                            <span class="reviewer_experienсe">Гуру</span>
                        </div>
                        <div class="review_text position-relative">
                <textarea id="{{$comment->id}}" name="message-{{$comment->id}}" style="resize: none;" disabled
                          class="border-0 w-100 bg-transparent"
                          maxlength="500"
                          minlength="10"
                >{{ Str::ucfirst($comment->message) }}</textarea>
                        </div>
                    </div>
                    <div class="review_bottom">
                        <a href="#">Read more ></a>
                        @if($comment->user == Auth::user())
                            <label for="message-{{$comment->id}}" message-name="{{ $comment->id }}" onclick="changeAttribute(this, 'disabled'); toggleClassName(document.getElementById('save-{{$comment->id}}'), ['opacity-0']); toggleClassName(document.getElementById('delete-{{$comment->id}}'), ['opacity-0']); toggleClassName(this, ['bg-transparent', 'bg-warning']);">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </label>
                            <div comment-save="{{$comment->id}}" id="save-{{$comment->id}}" class="opacity-0" onclick="updateComment(this, 'update')">
                                <i class="fa-solid fa-floppy-disk"></i>
                            </div>
                            <div comment-delete="{{$comment->id}}" id="delete-{{$comment->id}}" class="" onclick="updateComment(this, 'delete')" style="color: red;">
                                <i class="fa-solid fa-trash-can"></i>
                            </div>
                            <div class="review_bottom_extra">
                <span>
                    <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                         width="1280.000000pt" height="1096.000000pt" viewBox="0 0 1280.000000 1096.000000"
                         preserveAspectRatio="xMidYMid meet">
<metadata>
Created by potrace 1.15, written by Peter Selinger 2001-2017
</metadata>
<g transform="translate(0.000000,1096.000000) scale(0.100000,-0.100000)"
   fill="#009688" stroke="none">
<path d="M9595 10950 c-55 -5 -289 -23 -520 -40 -231 -17 -539 -39 -685 -50
-146 -11 -821 -60 -1500 -110 -679 -50 -1356 -99 -1505 -110 -525 -39 -1094
-80 -2320 -170 -682 -50 -1283 -97 -1335 -106 -431 -68 -820 -265 -1125 -569
-338 -336 -542 -764 -594 -1247 -20 -178 -23 -119 89 -1643 16 -220 43 -587
60 -815 17 -228 62 -847 100 -1375 38 -528 77 -1009 85 -1068 61 -424 249
-811 544 -1120 161 -168 358 -313 586 -429 66 -34 246 -129 400 -212 374 -201
455 -239 604 -288 69 -23 128 -42 129 -44 4 -2 81 -1045 82 -1090 0 -14 75
-89 244 -243 l245 -221 698 533 c384 294 846 647 1026 784 l328 251 122 6 c67
4 583 22 1147 41 3304 112 4525 156 4605 165 929 109 1647 875 1691 1805 3 66
-4 379 -15 695 -11 316 -39 1099 -61 1740 -71 2068 -79 2261 -95 2364 -61 397
-215 711 -516 1051 -348 392 -740 828 -808 899 -309 319 -707 527 -1151 601
-114 19 -416 27 -555 15z m492 -265 c702 -100 1270 -597 1467 -1285 49 -174
47 -148 146 -1505 17 -231 44 -600 60 -820 189 -2570 182 -2463 176 -2640 -6
-195 -33 -346 -91 -515 -128 -367 -391 -702 -715 -912 -174 -113 -404 -207
-605 -247 -116 -23 -215 -33 -595 -61 -239 -17 -3077 -224 -3835 -280 -466
-34 -1071 -79 -1316 -96 l-236 -18 -814 -673 c-583 -482 -815 -668 -817 -655
-3 24 -71 964 -79 1096 l-6 108 -51 -5 c-195 -22 -440 -30 -561 -19 -827 76
-1473 674 -1609 1487 -8 50 -47 527 -86 1060 -39 534 -84 1150 -100 1370 -158
2139 -162 2199 -157 2345 7 171 26 293 73 448 169 560 605 1002 1164 1180 184
58 280 72 780 107 195 14 474 34 620 45 146 11 1005 74 1910 140 905 66 1764
129 1910 140 146 11 459 34 695 51 237 17 840 62 1340 99 956 71 1160 80 1332
55z"/>
</g>
</svg> 127</span>
                                <span>
                    <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                         width="1280.000000pt" height="1133.000000pt" viewBox="0 0 1280.000000 1133.000000"
                         preserveAspectRatio="xMidYMid meet">
<metadata>
Created by potrace 1.15, written by Peter Selinger 2001-2017
</metadata>
<g transform="translate(0.000000,1133.000000) scale(0.100000,-0.100000)"
   fill="#009688" stroke="none">
<path d="M3139 11319 c-408 -27 -834 -123 -1165 -260 -251 -104 -542 -274
-744 -435 -119 -95 -371 -349 -470 -474 -503 -634 -784 -1509 -757 -2360 10
-290 39 -472 113 -703 202 -627 670 -1387 1430 -2323 1102 -1358 2896 -3120
4835 -4751 17 -14 -8 -34 379 296 1471 1256 2963 2699 3971 3841 1131 1281
1811 2338 2000 3105 114 466 84 1111 -81 1694 -109 385 -294 773 -520 1088
-470 656 -1180 1085 -2040 1232 -257 44 -402 55 -730 55 -337 0 -452 -10 -695
-59 -722 -146 -1301 -530 -1717 -1140 -199 -291 -327 -559 -467 -973 -42 -123
-80 -224 -86 -224 -5 0 -40 78 -76 173 -159 420 -305 705 -516 1006 -267 382
-631 711 -1003 907 -478 252 -1010 349 -1661 305z"/>
</g>
</svg> 18</span>
                            </div>
                        @endif

                    </div>
                </div>
                <div class="avatar_img_box">
                    <a href="{{ route('profile.show', $comment->user->slug) }}"  class="@if($comment->user->is_private) disabled @endif position-relative">
                        <img style="object-fit: cover;" src="{!! $comment->user->avatar ?? asset('images/default_avatar.png') !!}" width="80" height="80" class="rounded-circle">
                        <i style="left: 0;" class="position-absolute fa-solid  {{$comment->user->is_private ? "fa-lock": "fa-lock-open"}}"></i>
                    </a>

                </div>
            </div>
        </section>

    @endif
@empty
    <h3>Комментариев пока нет</h3>
@endforelse
@push('js')
    <script src="{{ asset('js/changeAttribute.js')}}"></script>
    <script src="{{ asset('js/toggleClassName.js')}}"></script>
    <script src="{{ asset('js/updateComment.js')}}"></script>
@endpush
