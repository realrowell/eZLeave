@extends('includes.home_layout')
@section('title','FAQ - Leave Application')
@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/profile_style.css?v=2') }}" />
@endsection
@section('content')

<div class="container bg-light pt-5 pb-5">
    {{-- <div class="row">
        <div class="col">
            <img src="{{ asset('img/bg_home.jpg') }}" class="img-fluid" alt="Bioseed Corn Field">
        </div>
    </div> --}}
    <div class="row">
        <div class="col-lg-8 col-md-12 col-sm-12 col-12">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <h1>
                            How to approve a leave application
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p>BRPI IT Support Team</p>
                    </div>
                    <div class="col text-end">
                        <p>Updated: {{ date('d M Y') }}</p>
                    </div>
                </div>
            </div>
            <div class="container mt-5">
                <ol>
                    <div id="#1">
                        <div class="row">
                            <div class="col">
                                <li id="#1">
                                    <b>Access the Approval Section:</b>
                                </li>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <b>Option 1:</b> On the Dashboard page, locate and click the “For your Approval”.
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <img src="{{ asset('img/articles/faq2_p1.png') }}" class="img-fluid" alt="faq1">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <b>Option 2:</b> Alternatively, navigate to the "Leave Management" tab and select the "For Approval" sub-menu.
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <img src="{{ asset('img/articles/faq2_p2.png') }}" class="img-fluid" alt="faq1">
                            </div>
                        </div>
                    </div>
                    <div class="mt-5" id="#2">
                        <div class="row">
                            <div class="col">
                                <li id="#2">
                                    <b>Select and Approve a Leave Application:</b>
                                </li>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Browse through the list of pending leave applications.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Click the “Approve” button on the leave application you want to approve.
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <img src="{{ asset('img/articles/faq2_p3.png') }}" class="img-fluid" alt="faq1">
                            </div>
                        </div>
                    </div>
                    <div class="mt-5" id="#3">
                        <div class="row">
                            <div class="col">
                                <li>
                                    <b>Confirm the Approval:</b>
                                </li>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                A confirmation prompt will appear to ensure you want to approve the leave application.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Review the details of the application once more to confirm everything is accurate.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Click the “Confirm Approval” button to finalize the process.
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <img src="{{ asset('img/articles/faq2_p4.png') }}" class="img-fluid" alt="faq1">
                            </div>
                        </div>
                    </div>
                    <div class="mt-5" id="#4">
                        <div class="row">
                            <div class="col">
                                <li>
                                    <b>Completion:</b>
                                </li>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                The creator of the leave application will receive an email confirming the approval of the application.
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <img src="{{ asset('img/articles/faq2_p6.png') }}" class="img-fluid" alt="faq1">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                The status of the leave application will be updated to reflect the approval that can be seen in the account of the creator of the leave application.
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <img src="{{ asset('img/articles/faq2_p5.png') }}" class="img-fluid" alt="faq1">
                            </div>
                        </div>
                    </div>
                </ol>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-12 pt-5 pb-5 border border-top-0 border-bottom-0 border-end-0">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <h4>
                            Our Portals
                        </h4>
                    </div>
                </div>
                @include('articles.faqs.portal_list')
            </div>
            <div class="container-fluid mt-5 ">
                <div class="row">
                    <div class="col">
                        <h4>
                            Frequently Asked Questions
                        </h4>
                    </div>
                </div>
                @include('articles.faqs.faq_list')
            </div>
        </div>
    </div>
</div>

@endsection
