<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memini - Aplicação Virtual Familiar</title>

    <!-- 1️⃣ Primeiro o Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- 2️⃣ Depois o teu CSS personalizado -->
    <!-- <link rel="stylesheet" href="{{asset('resources\css\index.css') }}"> -->
    @vite(['resources/css/index.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Navigation -->
    <nav class="nav-bar">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                logo
                <div class="flex items-center space-x-2">
                    <img src="caminho/para/logo.png" alt="Memini Logo" class="w-12 h-12 object-contain">
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#home" class="nav-link">Home</a>
                    <a href="#sobre" class="nav-link">Sobre nós</a>
                    <a href="#solucoes" class="nav-link">Soluções</a>
                    <a href="#contacto" class="nav-link">Contactos</a>
                </div>
                <a href="#login" class="btn-primary">Login →</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative py-20 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 1000 300" preserveAspectRatio="none">
                <path d="M0,100 Q250,50 500,100 T1000,100 L1000,300 L0,300 Z" fill="currentColor" class="wave-1"/>
                <path d="M0,150 Q250,100 500,150 T1000,150 L1000,300 L0,300 Z" fill="currentColor" class="wave-2"/>
                <path d="M0,200 Q250,150 500,200 T1000,200 L1000,300 L0,300 Z" fill="currentColor" class="wave-3"/>
            </svg>
        </div>
        <div class="container mx-auto px-6 text-center relative z-10">
            <h1 class="hero-title text-5xl md:text-6xl font-bold mb-4">Memini</h1>
            <p class="hero-subtitle text-xl">A tua aplicação virtual familiar para sempre!</p>
        </div>
    </section>

    <!-- (restante conteúdo mantém-se exatamente igual ao teu) -->
    <!-- Confiado por -->
    <section class="py-12">
        <div class="container mx-auto px-6 text-center">
            <h3 class="text-secondary text-lg mb-4">Confiado por:</h3>
            <p class="text-muted text-sm">Famílias por todo o país</p>
        </div>
    </section>

    <!-- Soluções -->
    <section id="solucoes" class="section-light py-16">
        <div class="container mx-auto px-6">
            <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-4">
                Que soluções é que a nossa app apresenta?
            </h2>
            <p class="text-center text-secondary mb-12 max-w-3xl mx-auto">
                A sua app apresenta recursos para gerenciar e preservar memórias, ajudar a organizar eventos familiares e garantir que informações importantes estejam sempre acessíveis.
            </p>

            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Card 1 -->
                <div class="card">
                    <div class="card-icon-wrapper">
                        <svg class="card-icon w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h3 class="card-title text-xl font-bold mb-3">Privacidade e Segurança Total</h3>
                    <p class="card-text">
                        Todas as memórias ficam protegidas com sistemas de criptografia avançados, garantindo que somente com familiares as possam aceder.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="card">
                    <div class="card-icon-wrapper">
                        <svg class="card-icon w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h3 class="card-title text-xl font-bold mb-3">Organização Personalizada</h3>
                    <p class="card-text">
                        Organize suas viagens, jantares, eventos, criando álbuns personalizados, permitindo que as memórias sejam facilmente encontradas e revividas quando quiser, de forma simples e prática.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="card">
                    <div class="card-icon-wrapper">
                        <svg class="card-icon w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="card-title text-xl font-bold mb-3">Multimédia Completa</h3>
                    <p class="card-text">
                        Suporta fotos, vídeos e áudios. Possibilita criar e manter viva histórias com os vídeos da família. Pode documentar receitas de família através de fotos e vídeos passo a passo.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Preços -->
    <section class="py-16">
        <div class="container mx-auto px-6 text-center">
            <h2 class="section-title text-3xl md:text-4xl font-bold mb-2">Preços?</h2>
            <p class="text-secondary mb-12">Descobre o nosso preçário</p>

            <div class="max-w-2xl mx-auto price-box">
                <h3 class="price-title text-3xl font-bold mb-4">É gratuito!</h3>
                <p class="price-subtitle mb-6">A nossa aplicação é 100% gratuita para todas famílias.</p>
                <p class="price-text text-sm max-w-xl mx-auto leading-relaxed">
                    Esta projeto é sustentado pelo nosso português, através de um programa de apoio de financiamento que começamos aqui nos estudantes da escola superior de Viana do Castelo. 
                    Chegámos aqui depois sobretudo por estudos profundos baleáricas de gratuitos, ligados à própria família, pois fazem os Profetas genéricos e guarda de suas memórias.
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
                    Somos uma equipa dedicada a preservar memórias familiares de forma segura, organizada e acessível, acreditamos que cada memória criada, guardada, sejam os primeiros passos de uma criança, festas de aniversário, casamentos, receitas de biscados e infinitas histórias, merece ser preservada e partilhada com amor.
                </p>
                <p>
                    Nossa missão é oferecer uma ferramenta simples, segura e eficiente para que famílias possam armazenar, organizar e reviver seus momentos mais preciosos a qualquer hora e em qualquer lugar.
                </p>
                <p>
                    Com a realização deste projeto é trabalhar, vamos ao encontro para ajudar todos aqueles que queiram melhorar a sua experiência familiar, melhorando relação e memórias de união familiar.
                </p>
                <p>
                    Nosso objetivo é transformar memórias de famílias além o mundo, com pessoas que amar famílias reais, EUA, além de motivação e digitalização e salvaguardar.
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
            <p class="text-center text-secondary mb-12">Confie e tenha objetivos certos e transmissão certos</p>

            <!-- Imagem Hero -->
            <div class="relative rounded-lg overflow-hidden mb-12 max-w-5xl mx-auto">
                <img src="/api/placeholder/1200/600" alt="Família feliz" class="w-full h-96 object-cover">
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
                        A vida é Judia por pequenos detalhes que existem e transformam cada dia ainda mais especial, sua família é nossa, os encontros de Natal, os aniversários e até mesmos dias comuns. Nosso aplicativo para documentar, organizar e compartilhar essa momentos de forma simples e segura.
                    </p>
                </div>

                <div class="value-card">
                    <p class="value-label text-sm font-semibold mb-3">A nossa visão</p>
                    <h3 class="value-title text-2xl font-bold mb-4">
                        Colocamos a família em 1º lugar preservando o que importa
                    </h3>
                    <p class="value-text leading-relaxed">
                        Acreditamos que cada histórias de aniversário está aonde de famílias, seja especial, neste memórias que profundos para com natureza transmite histórias. 
                        Necessitamos um familiar forte, unida, partilham que famílias, estejam onde memória desses, assim criar e junto seguros fortes.
                    </p>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="#sobre" class="btn-secondary">
                    Sobre nós →
                </a>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="section-light py-16">
        <div class="container mx-auto px-6">
            <h2 class="section-title text-3xl md:text-4xl font-bold mb-12">FAQ</h2>

            <div class="max-w-3xl mx-auto space-y-4">
                <!-- FAQ Item 1 -->
                <details class="faq-item">
                    <summary class="faq-question font-semibold cursor-pointer flex justify-between items-center">
                        A minha informação está segura?
                        <svg class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </summary>
                    <p class="faq-answer mt-4">
                        Absolutamente! A aplicação é totalmente responsiva e funciona perfeitamente em smartphones, tablets e computadores.
                    </p>
                </details>

                <!-- FAQ Item 3 -->
                <details class="faq-item">
                    <summary class="faq-question font-semibold cursor-pointer flex justify-between items-center">
                        Posso convidar parentes/amizades?
                        <svg class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </summary>
                    <p class="faq-answer mt-4">
                        Sim! Você pode convidar membros da família e amigos próximos para compartilhar e colaborar nas memórias familiares.
                    </p>
                </details>

                <!-- FAQ Item 4 -->
                <details class="faq-item">
                    <summary class="faq-question font-semibold cursor-pointer flex justify-between items-center">
                        O que fazer se eu perder acesso à conta?
                        <svg class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </summary>
                    <p class="faq-answer mt-4">
                        Oferecemos um processo de recuperação de conta seguro. Entre em contato com nosso suporte para assistência imediata.
                    </p>
                </details>
            </div>

            <div class="text-center mt-8">
                <a href="#faq" class="btn-secondary">
                    Ler todas as FAQs →
                </a>
            </div>
        </div>
    </section>

    <!-- Contacto -->
    <section id="contacto" class="py-16">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12 max-w-5xl mx-auto">
                <!-- Form -->
                <div>
                    <h3 class="form-label text-sm font-semibold mb-6 uppercase">Manda o teu email</h3>
                    
                    <form class="space-y-6">
                        <div>
                            <input type="text" 
                                   placeholder="INSIRA SEU APELIDO E O SEU REPRESENTANTE" 
                                   class="form-input w-full px-4 py-3 rounded-md">
                        </div>
                        
                        <div>
                            <label class="form-label block text-sm font-semibold mb-2 uppercase">Insira o seu email</label>
                            <input type="email" 
                                   placeholder="INSIRA O SEU EMAIL" 
                                   class="form-input w-full px-4 py-3 rounded-md">
                        </div>
                        
                        <div>
                            <label class="form-label block text-sm font-semibold mb-2 uppercase">Qual é a sua pergunta?</label>
                            <textarea rows="4" 
                                      placeholder="ESCREVA" 
                                      class="form-input w-full px-4 py-3 rounded-md resize-none"></textarea>
                        </div>
                    </form>
                </div>

                <!-- Contact Info -->
                <div>
                    <h2 class="section-title text-3xl md:text-4xl font-bold mb-6">Contacte-nos</h2>
                    <p class="contact-text mb-8">
                        Quer saber o nosso acesso diariamente! Tire suas dúvidas
                    </p>
                    <a href="#contacto" class="btn-secondary">
                        Clique aqui se não respondermos →
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="footer">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                        </svg>
                        <span class="footer-logo text-xl font-semibold">Memini</span>
                    </div>
                    <p class="footer-text text-sm leading-relaxed max-w-md">
                        Ajudamos as famílias a preservarem suas histórias mais preciosas de forma segura e organizada.
                    </p>
                </div>
            </div>
            <div class="footer-bottom border-t pt-8 flex flex-col md:flex-row justify-between items-center text-sm">
                <p>&copy; 2025 Memini. Todos os direitos reservados.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#privacidade" class="footer-link">Política de Privacidade</a>
                    <a href="#termos" class="footer-link">Termos de Uso</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>






    
    