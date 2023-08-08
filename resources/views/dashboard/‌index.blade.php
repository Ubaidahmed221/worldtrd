    @extends('layouts.dashboard-layout')

    @section('content')
        <div class="main_content_iner overly_inner ">
            <div class="container-fluid p-0 ">

                <div class="row">
                    <div class="col-12">
                        <div class="page_title_box d-flex align-items-center justify-content-between">
                            <div class="page_title_left">
                                <h3 class="f_s_30 f_w_700 text_white">Dashboard</h3>
                                <a href="" class="text-white h6 text-decoration-underline">Refresh</a>
                                
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row ">

                    <div class="col-lg-3">
                        <div class="white_card card_height_100 mb_20">
                            <div class="white_card_header">
                                <div class="box_header m-0">
                                    <div class="main-title">
                                        @if (session()->get('role') == 3 || session()->get('role') == 4)
                                        <h3 class="m-0">Total All User Current Balance:</h3>
                                        @else
                                        <h3 class="m-0">Current Balance:</h3>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="white_card_body">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" fill="currentColor" class="bi bi-coin" viewBox="0 0 16 16">
  <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z"/>
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/>
</svg>

                                <h4 class="f_w_900 f_s_35 mb-0 me-2">${{$balance}}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="white_card card_height_100 mb_20">
                            <div class="white_card_header">
                                <div class="box_header m-0">
                                    <div class="main-title">
                                        @if (session()->get('role') == 3 || session()->get('role') == 4)
                                        <h3 class="m-0">Total All User Deposit:</h3>
                                        @else
                                        <h3 class="m-0">Total Deposit:</h3>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="white_card_body">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                    <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                  </svg>

                                <h4 class="f_w_900 f_s_35 mb-0 me-2">$@if ($deposit[0]->depositamount)
                                    {{$deposit[0]->depositamount}}
                                    @else
                                    0
                                @endif</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="white_card card_height_100 mb_20">
                            <div class="white_card_header">
                                <div class="box_header m-0">
                                    <div class="main-title">
                                        @if (session()->get('role') == 3 || session()->get('role') == 4)
                                        <h3 class="m-0">Total All User Investement:</h3>
                                        @else
                                        <h3 class="m-0">Total Investement:</h3>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="white_card_body">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" fill="currentColor" class="bi bi-incognito" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="m4.736 1.968-.892 3.269-.014.058C2.113 5.568 1 6.006 1 6.5 1 7.328 4.134 8 8 8s7-.672 7-1.5c0-.494-1.113-.932-2.83-1.205a1.032 1.032 0 0 0-.014-.058l-.892-3.27c-.146-.533-.698-.849-1.239-.734C9.411 1.363 8.62 1.5 8 1.5c-.62 0-1.411-.136-2.025-.267-.541-.115-1.093.2-1.239.735Zm.015 3.867a.25.25 0 0 1 .274-.224c.9.092 1.91.143 2.975.143a29.58 29.58 0 0 0 2.975-.143.25.25 0 0 1 .05.498c-.918.093-1.944.145-3.025.145s-2.107-.052-3.025-.145a.25.25 0 0 1-.224-.274ZM3.5 10h2a.5.5 0 0 1 .5.5v1a1.5 1.5 0 0 1-3 0v-1a.5.5 0 0 1 .5-.5Zm-1.5.5c0-.175.03-.344.085-.5H2a.5.5 0 0 1 0-1h3.5a1.5 1.5 0 0 1 1.488 1.312 3.5 3.5 0 0 1 2.024 0A1.5 1.5 0 0 1 10.5 9H14a.5.5 0 0 1 0 1h-.085c.055.156.085.325.085.5v1a2.5 2.5 0 0 1-5 0v-.14l-.21-.07a2.5 2.5 0 0 0-1.58 0l-.21.07v.14a2.5 2.5 0 0 1-5 0v-1Zm8.5-.5h2a.5.5 0 0 1 .5.5v1a1.5 1.5 0 0 1-3 0v-1a.5.5 0 0 1 .5-.5Z"/>
                                  </svg>

                                <h4 class="f_w_900 f_s_35 mb-0 me-2">$@if ($invest[0]->investamount)
                                    {{$invest[0]->investamount}}
                                    @else
                                    0
                                @endif</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="white_card card_height_100 mb_20">
                            <div class="white_card_header">
                                <div class="box_header m-0">
                                    <div class="main-title">
                                        @if (session()->get('role') == 3 || session()->get('role') == 4)
                                        <h3 class="m-0">Total All User Withdraw:</h3>
                                        @else
                                        <h3 class="m-0">Total Withdraw:</h3>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="white_card_body">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" fill="currentColor" class="bi bi-easel3-fill" viewBox="0 0 16 16">
                                    <path d="M8.5 12v1.134a1 1 0 1 1-1 0V12h-5A1.5 1.5 0 0 1 1 10.5V3h14v7.5a1.5 1.5 0 0 1-1.5 1.5h-5Zm7-10a.5.5 0 0 0 0-1H.5a.5.5 0 0 0 0 1h15Z"/>
                                  </svg>

                                <h4 class="f_w_900 f_s_35 mb-0 me-2">$@if ($withdraw[0]->withdrawamount)
                                    {{$withdraw[0]->withdrawamount}}
                                    @else
                                    0
                                @endif</h4>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    @endsection
