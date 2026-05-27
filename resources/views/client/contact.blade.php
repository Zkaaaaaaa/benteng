@extends('layouts.client.app')

@section('title', 'Contact - BENTENG')

@section('content')
    <!-- Header Section -->
    <div class="bg-edward-500 relative py-20 overflow-hidden">
        <div class="container z-10 relative text-white text-center">
            <h1 class="font-display text-5xl lg:text-6xl uppercase tracking-wider mb-2">Contact Ons</h1>
            <p class="text-lg max-w-xl mx-auto opacity-90">Hebt u vragen, opmerkingen of wilt u een bestelling bespreken?
                Neem gerust contact met ons op!</p>
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/20 to-black/40 z-0"></div>
    </div>

    <!-- Contact Content Section -->
    <div class="container py-16 lg:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

            <!-- Left Column: Contact Information -->
            <div class="lg:col-span-5 space-y-8">
                <div>
                    <h2 class="font-display text-3xl uppercase text-gray-900 border-b-2 border-red-500 pb-3 mb-6">Onze
                        Gegevens</h2>
                    <p class="text-gray-600 mb-6">BENTENG is al sinds 2001 het vertrouwde adres voor authentieke Indonesische
                        gerechten in Den Haag. Kom gezellig langs of neem contact met ons op!</p>
                </div>

                <div class="space-y-6">
                    <!-- Address Info -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-red-100 text-red-500 p-3 rounded-lg mr-4">
                            <i class="lni lni-map-marker text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 uppercase text-sm tracking-wider">Adres</h4>
                            <a href="https://goo.gl/maps/iHQEbT6gGWj2NSfu6" target="_blank"
                                class="text-gray-600 hover:text-red-500 transition-colors duration-300">
                                Alexander Boersstraat 31, 1071 KV Amsterdam
                            </a>
                        </div>
                    </div>

                    <!-- Tel Info -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-red-100 text-red-500 p-3 rounded-lg mr-4">
                            <i class="lni lni-phone text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 uppercase text-sm tracking-wider">Telefoon</h4>
                            <a href="tel:0202217744"
                                class="text-gray-600 hover:text-red-500 font-bold transition-colors duration-300">
                                020 221 7744
                            </a>
                        </div>
                    </div>

                    <!-- Email Info -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-red-100 text-red-500 p-3 rounded-lg mr-4">
                            <i class="lni lni-envelope text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 uppercase text-sm tracking-wider">E-mail</h4>
                            <a href="mailto:info@tokobenteng.nl"
                                class="text-gray-600 hover:text-red-500 transition-colors duration-300">
                                info@tokobenteng.nl
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Openingstijden Card -->
                <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                    <h3 class="font-display text-2xl uppercase text-gray-900 mb-4 flex items-center">
                        <i class="lni lni-timer text-red-500 mr-2"></i> Openingstijden
                    </h3>
                    <table class="w-full text-sm">
                        <tbody class="divide-y divide-gray-200/50">
                            <tr>
                                <th class="py-2 text-left font-medium text-gray-500">Maandag</th>
                                <td class="py-2 text-right text-gray-700 font-semibold">14:00 - 21:00</td>
                            </tr>
                            <tr>
                                <th class="py-2 text-left font-medium text-gray-500">Dinsdag</th>
                                <td class="py-2 text-right text-gray-700">14:00 - 21:00</td>
                            </tr>
                            <tr>
                                <th class="py-2 text-left font-medium text-gray-500">Woensdag</th>
                                <td class="py-2 text-right text-gray-700">14:00 - 21:00</td>
                            </tr>
                            <tr>
                                <th class="py-2 text-left font-medium text-gray-500">Donderdag</th>
                                <td class="py-2 text-right text-gray-700">14:00 - 21:00</td>
                            </tr>
                            <tr>
                                <th class="py-2 text-left font-medium text-gray-500">Vrijdag</th>
                                <td class="py-2 text-right text-gray-700">14:00 - 21:00</td>
                            </tr>
                            <tr>
                                <th class="py-2 text-left font-medium text-gray-500">Zaterdag</th>
                                <td class="py-2 text-right text-gray-700">14:00 - 21:00</td>
                            </tr>
                            <tr>
                                <th class="py-2 text-left font-medium text-gray-500">Zondag</th>
                                <td class="py-2 text-right text-gray-700 font-semibold">14:00 - 21:00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Right Column: Interactive Contact Form -->
            <div class="lg:col-span-7 bg-white shadow-2xl p-8 lg:p-12 border border-gray-100 rounded-2xl relative">
                <div class="absolute top-0 right-0 w-24 h-24 bg-red-500/5 rounded-bl-full z-0 pointer-events-none"></div>

                <div class="relative z-10">
                    <h2 class="font-display text-3xl uppercase text-gray-900 border-b-2 border-red-500 pb-3 mb-6">Stuur ons
                        een Bericht</h2>

                    <form action="#" method="POST" class="space-y-6"
                        onsubmit="event.preventDefault(); alert('Bedankt! Uw bericht is succesvol verzonden.'); this.reset();">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="client-name"
                                    class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Naam <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="client-name" name="name" required
                                    class="w-full px-4 py-3 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 rounded-lg outline-none transition duration-300"
                                    placeholder="Uw naam">
                            </div>
                            <div>
                                <label for="client-email"
                                    class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">E-mailadres
                                    <span class="text-red-500">*</span></label>
                                <input type="email" id="client-email" name="email" required
                                    class="w-full px-4 py-3 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 rounded-lg outline-none transition duration-300"
                                    placeholder="Uw emailadres">
                            </div>
                        </div>

                        <div>
                            <label for="client-subject"
                                class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Onderwerp</label>
                            <input type="text" id="client-subject" name="subject"
                                class="w-full px-4 py-3 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 rounded-lg outline-none transition duration-300"
                                placeholder="Waar gaat uw bericht over?">
                        </div>

                        <div>
                            <label for="client-message"
                                class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Bericht <span
                                    class="text-red-500">*</span></label>
                            <textarea id="client-message" name="message" rows="5" required
                                class="w-full px-4 py-3 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 rounded-lg outline-none transition duration-300"
                                placeholder="Typ hier uw bericht..."></textarea>
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full py-4 bg-red-500 hover:bg-red-700 text-white font-bold uppercase tracking-widest text-sm rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out transform hover:-translate-y-0.5">
                                <i class="lni lni-telegram-original mr-2"></i> Bericht Verzenden
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Map Section -->
    <div class="w-full h-96 bg-gray-200 relative overflow-hidden">
        <!-- Interactive Leaflet map or Google Maps Embed iframe matching Den Haag location -->
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2451.2721868516086!2d4.275039377196024!3d52.093006471953284!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f131!3m3!1m2!1s0x47c5b12852233f2d%3A0xe51fe66c1b3f740a!2sAbeelplein%203%2C%202565%20XS%20Den%20Haag%2C%20Netherlands!5e0!3m2!1sen!2sid!4v1716656000000!5m2!1sen!2sid"
            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade" class="absolute inset-0">
        </iframe>
    </div>
@endsection
