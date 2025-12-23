<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memini - Aplicação Virtual Familiar</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- CSS -->
    <!-- <link rel="stylesheet" href="{{asset('resources\css\index.css') }}"> -->
    @vite(['resources/css/index.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Navigation -->
    <nav class="nav-bar shadow-md">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex-shrink-0">
                    <img src="http://localhost/assets/img/logo-dark.png" alt="Memini Logo" class="object-contain">
                </div>

                <div class="hidden md:flex flex-1 justify-center space-x-8">
                    <a href="#home" class="nav-link">Home</a>
                    <a href="#sobre" class="nav-link">Sobre nós</a>
                    <a href="#solucoes" class="nav-link">Soluções</a>
                    <a href="#contacto" class="nav-link">Contactos</a>
                </div>

                <div class="flex-shrink-0">
                    <a href="{{ route('dashboard') }}" class="btn-primary">Login →</a>
                </div>
            </div>
        </div>
    </nav>


    <!-- Hero Section -->
    <section class="hero relative py-20 overflow-hidden">
        <div class="container mx-auto px-6 text-center relative z-10">
            <h1 class="hero-title text-5xl md:text-6xl font-bold mb-4">Memini</h1>
            <p class="hero-subtitle text-xl">A sua aplicação de cloud familiar e pessoal.</p>
        </div>
    </section>

    <!-- Confiado por -->
    <section class="trusted-section py-12">
        <div class="container mx-auto px-6 text-center">
            <h3 class="trusted-title mb-2">Confiado por:</h3>
            <p class="trusted-subtitle text-muted text-sm">Famílias por todo o globo</p>
        </div>
    </section>

    <!-- Soluções -->
    <section id="solucoes" class="section-light py-16">
        <div class="container mx-auto px-6">
            <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-4">
                Que soluções é que a nossa app apresenta?
            </h2>
            <p class="text-center text-secondary mb-12 max-w-3xl mx-auto">
                A sua app apresenta várias soluções claras para famílias que querem guardar e organizar memórias de forma segura e prática.
            </p>

            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Card 1 -->
                <div class="card">
                    <div class="card-icon-wrapper">
                        <svg class="card-icon w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="card-title text-xl font-bold mb-3">Privacidade e Segurança Total</h3>
                    <p class="card-text">
                        Todas as memórias ficam protegidas, compartilhadas apenas com familiares via links seguros.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="card">
                    <div class="card-icon-wrapper">
                        <svg class="card-icon w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="card-title text-xl font-bold mb-3">Organização Personalizada</h3>
                    <p class="card-text">
                        Permite criar projetos para cada criança, viagem ou evento familiar, com múltiplos álbuns dentro de cada projeto para facilitar a organização e o acesso rápido às memórias.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="card">
                    <div class="card-icon-wrapper">
                        <svg class="card-icon w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="card-title text-xl font-bold mb-3">Multimédia Completa</h3>
                    <p class="card-text">
                        Suporta fotos, vídeos e áudios, possibilitando guardar momentos de formas diversas — como a primeira palavra de uma criança ou vídeos de aniversários — tornando a experiência mais rica e interativa do que apps apenas de fotos.
                </div>
            </div>
        </div>
    </section>

    <!-- Preços -->
    <section class="py-16">
        <div class="container mx-auto px-6 text-center">
            <h2 class="section-title text-3xl md:text-4xl font-bold mb-2">Preços?</h2>
            <p class="text-secondary mb-12">Descubra o nosso preçário</p>

            <div class="max-w-2xl mx-auto price-box">
                <h3 class="price-title text-3xl font-bold mb-4">É gratuito!</h3>
                <p class="price-subtitle mb-6">A nossa aplicação é 100% gratuita para todas famílias.</p>
                <p class="price-text text-sm max-w-xl mx-auto leading-relaxed">
                    A nossa aplicação é 100% gratuita para todas as famílias.

                    Este projeto é sustentado pelo Estado português, através de um programa que apoia iniciativas dedicadas a fortalecer os laços familiares e incentivar a natalidade em Portugal. <br>
                    <br>
                    Graças a este apoio, conseguimos oferecer uma plataforma totalmente gratuita, segura e privada, para que todas as famílias possam guardar e partilhar as suas memórias sem custos.
                </p>
            </div>
        </div>
    </section>

    <!-- Quem somos -->
    <section id="sobre" class="section-light py-16">
        <div class="container mx-auto px-6">
            <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-2">
                Quem somos nós?
            </h2>
            <p class="text-center text-secondary mb-12">Conheça um pouco mais sobre nós!</p>

            <div class="max-w-4xl mx-auto space-y-6 about-text leading-relaxed">
                <p>
                    Somos uma equipa dedicada a preservar memórias familiares de forma segura, organizada e acessível, acreditamos que cada memória criada, guardada, sejam os primeiros passos de uma criança, festas de aniversário, casamentos e infinitas histórias, merece ser preservada e partilhada com amor.
                </p>
                <p>
                    Nossa missão é oferecer uma ferramenta simples, segura e eficiente para que famílias possam armazenar, organizar e reviver seus momentos mais preciosos a qualquer hora e em qualquer lugar.
                </p>
                <p>
                    Com a nossa app, compartilhar memórias é simples, seguro e exclusivo para quem realmente importa: A tua família.
                </p>
                <p>
                    Nosso objetivo é transformar memórias em histórias vivas, criando um espaço digital onde cada foto, vídeo ou áudio é valorizado e protegido.
                </p>
            </div>
        </div>
    </section>

    <!-- Valores -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-2">
                Conheça os nossos valores
            </h2>
            <p class="text-center text-secondary mb-12">Conheça o nosso objetivo e porque o queremos cumprir</p>

            <!-- Imagem Hero -->
            <div class="relative rounded-lg overflow-hidden mb-12 max-w-5xl mx-auto">
                <img src="http://localhost/assets/img/landing-page/familia-feliz.png" alt="Família feliz" class="w-full h-96 object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end">
                    <div class="p-8">
                        <p class="mission-label text-sm uppercase mb-2">Nossa Missão</p>
                        <h3 class="mission-title text-2xl md:text-3xl font-bold">
                            Construindo um Futuro de Bem-Estar Familiar e<br>Felicidade Duradoura
                        </h3>
                    </div>
                </div>
            </div>

            <!-- Cards de valores -->
            <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <div class="value-card">
                    <p class="value-label text-sm font-semibold mb-3">A nossa missão</p>
                    <h3 class="value-title text-2xl font-bold mb-4">
                        Ajudar famílias a preservar e celebrar as suas memórias
                    </h3>
                    <p class="value-text leading-relaxed">
                        Com o apoio de um programa estatal que incentiva a natalidade em Portugal, queremos fortalecer os laços familiares e promover um futuro onde cada história possa ser recordada, passada e valorizada entre gerações.
                        <br>
                        <br>
                        Criamos esta plataforma para que guardar memórias seja um gesto de amor, e não uma preocupação com custos, segurança ou privacidade.

                    </p>
                </div>

                <div class="value-card">
                    <p class="value-label text-sm font-semibold mb-3">A nossa visão</p>
                    <h3 class="value-title text-2xl font-bold mb-4">
                        Colocamos a família em 1º lugar
                    </h3>
                    <p class="value-text leading-relaxed">
                        Acreditamos na privacidade e segurança como pilares essenciais, garantindo que cada memória seja partilhada apenas com quem realmente importa.
                        <br>
                        <br>
                        Valorizamos a simplicidade e acessibilidade, para que qualquer pessoa, de qualquer idade, possa usar a aplicação facilmente.
                    </p>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('dashboard') }}" class="btn-secondary">
                    Vamos começar →
                </a>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="faq-section section-light py-16">
        <div class="container mx-auto px-6">
            <div>
                <h2 class="section-title text-3xl md:text-4xl font-bold">FAQ</h2>
                <p class="faq-description">Esclareça as suas dúvidas para simplificar a sua compreensão da Memini.</p>
                <div class="text-center">
                    <a href="{{ route('dashboard') }}" class="btn-secondary">
                        Esclarecido? →
                    </a>
                </div>
            </div>

            <div class="max-w-3xl space-y-4">
                <!-- FAQ Item 1 -->
                <details class="faq-item">
                    <summary class="faq-question font-semibold cursor-pointer flex justify-between items-center">
                        A minha informação está segura?
                        <svg class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </summary>
                    <p class="faq-answer mt-4">
                        Sim! Utilizamos criptografia avançada e medidas de segurança rigorosas para proteger todas as suas memórias e informações pessoais.
                    </p>
                </details>

                <!-- FAQ Item 2 -->
                <details class="faq-item">
                    <summary class="faq-question font-semibold cursor-pointer flex justify-between items-center">
                        A app funciona em dispositivos móveis e desktop?
                        <svg class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </summary>
                    <p class="faq-answer mt-4">
                        Absolutamente! A aplicação é totalmente responsiva e funciona perfeitamente em smartphones, tablets e computadores.
                    </p>
                </details>

                <!-- FAQ Item 3 -->
                <details class="faq-item">
                    <summary class="faq-question font-semibold cursor-pointer flex justify-between items-center">
                        Posso controlar permissões?
                        <svg class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </summary>
                    <p class="faq-answer mt-4">
                        Sim! Você pode convidar membros da família e amigos próximos para compartilhar e colaborar nas memórias familiares.
                    </p>
                </details>

                <!-- FAQ Item 4 -->
                <details class="faq-item">
                    <summary class="faq-question font-semibold cursor-pointer flex justify-between items-center">
                        O que fazer se perder acesso à conta?
                        <svg class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </summary>
                    <p class="faq-answer mt-4">
                        Oferecemos um processo de recuperação de conta seguro. Entre em contato com nosso suporte para assistência imediata.
                    </p>
                </details>
            </div>
        </div>
    </section>

    <!-- Contacto -->
    <section id="contacto" class="py-16">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12 max-w-5xl mx-auto">
                <!-- Form -->
                <div>
                    <livewire:landing-page.contact-form />
                </div>

                <!-- Contact Info -->
                <div>
                    <h2 class="section-title text-3xl md:text-4xl font-bold mb-6">Contacte-nos</h2>
                    <p class="contact-text mb-8">
                        Fale com a nossa equipa diretamente
                    </p>
                    <a href="mailto:contato@memini.com" class="btn-secondary">
                        Ou envie um email diretamente →
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="footer">
        <div class="container mx-auto px-6">
            <div class="footer-grid">
                <!-- Coluna 1 - Logo e Descrição -->
                <div class="footer-col-logo">
                    <div class="mb-4">
                        <img src="http://localhost/assets/img/logo-dark.png" alt="Memini Logo" class="footer-logo">
                    </div>
                    <p class="footer-text">
                        Memini é uma plataforma segura e privada para guardar, organizar e compartilhar memórias familiares. Crie projetos e álbuns, faça upload de fotos, vídeos e áudios, e compartilhe momentos especiais com quem você escolher, mantendo suas lembranças sempre protegidas e organizadas.
                    </p>
                </div>

                <!-- Coluna 2 - Links de Navegação -->
                <div class="footer-col-links">
                    <nav class="footer-nav">
                        <a href="#home" class="footer-link">Home →</a>
                        <a href="#solucoes" class="footer-link">Soluções →</a>
                        <a href="#sobre" class="footer-link">Sobre Nós →</a>
                        <a href="#contacto" class="footer-link">Contactos →</a>
                    </nav>
                </div>

                <!-- Coluna 3 - Redes Sociais e Contactos -->
                <div class="footer-col-contact">
                    <nav class="footer-nav">
                        <a href="https://instagram.com" target="_blank" class="footer-link">Instagram →</a>
                        <a href="https://youtube.com" target="_blank" class="footer-link">YouTube →</a>
                        <a href="mailto:support@memini.com" class="footer-link">support@memini.com</a>
                        <a href="tel:+351933994686" class="footer-link">+351 914 536 034</a>
                    </nav>
                </div>
            </div>
        </div>
    </footer>

    <!-- Java Script -->
    <script>
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.addEventListener('DOMContentLoaded', () => {
            const animatedElements = document.querySelectorAll(
                '#solucoes .card, .faq-item, .value-card, .price-box, .about-text, #contacto form > div'
            );

            animatedElements.forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
                observer.observe(el);
            });
        });
    </script>
</body>

</html>