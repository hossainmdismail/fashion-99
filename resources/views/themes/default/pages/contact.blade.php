@extends('themes.default.layout.app')

@section('content')
    <div class="py-0 py-md-5"></div>
    <main>
        <div class="mb-4 pb-4"></div>
        <section class="contact-us container">
            <div class="mw-930">
                <h2 class="page-title">CONTACT US</h2>
            </div>
        </section>

        <section class="google-map mb-5">
            <h2 class="d-none">Contact US</h2>
            <div id="map" class="container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58419.69449599461!2d90.33051629147144!3d23.774790485105893!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c0d5df6a0967%3A0x90af34284e1d79c6!2sLane%20No.%201%2C%20Dhaka%201216!5e0!3m2!1sen!2sbd!4v1729019158432!5m2!1sen!2sbd"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>

        <section class="contact-us container">
            <div class="mw-930">
                <div class="row mb-5">
                    <div class="col-lg-6">
                        <h3 class="mb-4">Store in Bangladesh</h3>
                        <p class="mb-4">{{ $configData->address }}<br>Bangladesh</p>
                        <p class="mb-4">{{ $configData->email }}<br>{{ $configData->number }}</p>
                    </div>
                    <div class="col-lg-6">
                        <h3 class="mb-4">Factory in Bangladesh</h3>
                        <p class="mb-4">{{ $configData->address }}<br>Bangladesh</p>
                        <p class="mb-4">{{ $configData->email }}<br>{{ $configData->number }}</p>
                    </div>
                </div>
                <div class="contact-us__form">
                    <form name="contact-us-form" class="needs-validation" novalidate>
                        <h3 class="mb-5">Get In Touch</h3>
                        <div class="form-floating my-4">
                            <input type="text" class="form-control" id="contact_us_name" placeholder="Name *" required>
                            <label for="contact_us_name">Name *</label>
                        </div>
                        <div class="form-floating my-4">
                            <input type="email" class="form-control" id="contact_us_email" placeholder="Email address *"
                                required>
                            <label for="contact_us_name">Email address *</label>
                        </div>
                        <div class="my-4">
                            <textarea class="form-control form-control_gray" placeholder="Your Message" cols="30" rows="8" required></textarea>
                        </div>
                        <div class="my-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
