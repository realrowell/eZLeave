@extends('includes.home_layout')
@section('title','FAQ - Leave Application')
@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/profile_style.css?v=1') }}" />
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
                            {{ $article_title }}
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p>{{ $article_author }}</p>
                    </div>
                    <div class="col text-end">
                        <p>Updated: {{ $article_date }}</p>
                    </div>
                </div>
            </div>
            <div class="container mt-5">
                <ol>
                    <div id="#1">
                        <div class="row">
                            <div class="col">
                                <li id="#1">
                                   <b>Navigate to the Leave Management Tab:</b>
                                </li>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Log in to your account.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                On the main dashboard, locate and click on the "Leave Management" tab.
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <img src="{{ asset('img/articles/faq1_p1.1.png') }}" class="img-fluid" alt="faq1">
                            </div>
                        </div>
                    </div>
                    <div class="mt-5" id="#2">
                        <div class="row">
                            <div class="col">
                                <li id="#2">
                                    <b>Access the Pending Approval Sub-menu:</b>
                                </li>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Within the Leave Management section, find the "Pending Approval" sub-menu.
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <img src="{{ asset('img/articles/faq1_p1.png') }}" class="img-fluid" alt="faq1">
                            </div>
                        </div>
                    </div>
                    <div class="mt-5" id="#3">
                        <div class="row">
                            <div class="col">
                                <li>
                                    <b>Apply for New Leave:</b>
                                </li>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <b>Option 1:</b> Click on the “Apply New” button.
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <img src="{{ asset('img/articles/faq1_p2.png') }}" class="img-fluid" alt="faq1">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <b>Option 2:</b> Alternatively, click on the leave card.
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <img src="{{ asset('img/articles/faq1_p3.png') }}" class="img-fluid" alt="faq1">
                            </div>
                        </div>
                    </div>
                    <div class="mt-5" id="#4">
                        <div class="row">
                            <div class="col">
                                <li>
                                    <b>Fill Out the Leave Application Form:</b>
                                </li>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                A new form will appear. Carefully fill in all the required details such as:
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <ul>
                                    <li><b>Leave Type:</b> Select the type of leave (e.g., vacation leave, sick leave).</li>
                                    <li><b>Start Date:</b> Choose the start date of your leave.</li>
                                    <li><b>End Date:</b> Choose the end date of your leave</li>
                                    <li><b>Half Day Option:</b> Check the checkbox for Morning or Afternoon if you want to avail only a half day; otherwise, leave it unchecked.</li>
                                    <li><b>Reason for Leave:</b> Provide a reason for your leave</li>
                                    <li><b>Attachments:</b> Upload any necessary documents, if required.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <img src="{{ asset('img/articles/faq1_p4.png') }}" class="img-fluid" alt="faq1">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <b>Sample:</b>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <img src="{{ asset('img/articles/faq1_p4.1.png') }}" class="img-fluid" alt="faq1">
                            </div>
                        </div>
                    </div>
                    <div class="mt-5" id="#5">
                        <div class="row">
                            <div class="col">
                                <li>
                                    <b>Submit Your Application</b>
                                </li>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Once you’ve completed the form, double-check all the information for accuracy.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Click on the “Create Application” button to submit your leave application for approval.
                            </div>
                        </div>
                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <img src="{{ asset('img/articles/faq1_p5.png') }}" class="img-fluid" alt="faq1">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                You will receive a confirmation message indicating that your application has been successfully submitted.
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
