<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\HeroSlide;
use App\Models\JourneyStep;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\SocialLink;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedSettings();
        $this->seedHeroSlides();
        $this->seedServices();
        $this->seedProjects();
        $this->seedJourneySteps();
        $this->seedFaqs();
        $this->seedSocialLinks();
    }

    private function seedSettings(): void
    {
        $settings = [
            // General & Brand
            ['key' => 'site_name', 'value' => 'Estúdio Norra', 'group' => 'general', 'type' => 'text', 'label' => 'Nome do Site'],
            ['key' => 'brand_tagline', 'value' => 'Onde o conceito torna-se arte.', 'group' => 'general', 'type' => 'text', 'label' => 'Slogan da Marca'],
            ['key' => 'brand_logo', 'value' => 'assets/logos/logo.svg', 'group' => 'general', 'type' => 'image', 'label' => 'Logo da Marca'],
            ['key' => 'brand_favicon', 'value' => 'settings/favicons/1779475070756-vkuzh.webp', 'group' => 'general', 'type' => 'image', 'label' => 'Favicon'],
            ['key' => 'footer_copyright', 'value' => '© 2026 ESTÚDIO NORRA • MULTIDISCIPLINAR POR ESSÊNCIA • TODOS OS DIREITOS RESERVADOS', 'group' => 'general', 'type' => 'text', 'label' => 'Texto de Copyright'],

            // Hero Section
            ['key' => 'hero_title', 'value' => 'Criamos experiências que tornam a sua marca irresistível', 'group' => 'hero', 'type' => 'text', 'label' => 'Título do Hero'],
            ['key' => 'hero_subtitle', 'value' => 'Ajudamos marcas consolidadas e fundadores exigentes a construir uma presença digital marcante, com estética autoral e tecnologia de alto desempenho.', 'group' => 'hero', 'type' => 'textarea', 'label' => 'Subtítulo do Hero'],
            ['key' => 'hero_cta_text', 'value' => 'Fale Conosco', 'group' => 'hero', 'type' => 'text', 'label' => 'Texto do Botão Hero'],
            ['key' => 'hero_badge_number', 'value' => '30+', 'group' => 'hero', 'type' => 'text', 'label' => 'Métrica do Hero'],
            ['key' => 'hero_badge_label', 'value' => 'marcas ajudadas', 'group' => 'hero', 'type' => 'text', 'label' => 'Legenda da Métrica Hero'],

            // Manifesto Section
            ['key' => 'manifesto_headline', 'value' => 'Entendemos que grandes fundadores merecem uma presença digital a altura do que estão construindo.', 'group' => 'manifesto', 'type' => 'textarea', 'label' => 'Manchete do Manifesto'],
            ['key' => 'manifesto_p1', 'value' => 'Muitas empresas desenvolveram marcas incríveis, mas seu website não reflete isso ainda.', 'group' => 'manifesto', 'type' => 'textarea', 'label' => 'Primeiro Parágrafo do Manifesto'],
            ['key' => 'manifesto_metric_number', 'value' => '1k+', 'group' => 'manifesto', 'type' => 'text', 'label' => 'Métrica do Manifesto'],
            ['key' => 'manifesto_metric_label', 'value' => 'designs entregues', 'group' => 'manifesto', 'type' => 'text', 'label' => 'Legenda do Manifesto'],

            // Final CTA Section
            ['key' => 'cta_title', 'value' => 'VAMOS CRIAR UMA EXPERIÊNCIA QUE MOVE SUA MARCA', 'group' => 'cta', 'type' => 'text', 'label' => 'Título do CTA Final'],
            ['key' => 'cta_subtitle', 'value' => 'Conte-nos sobre a sua visão. Vamos estruturar a melhor solução de design e engenharia para o seu negócio.', 'group' => 'cta', 'type' => 'textarea', 'label' => 'Subtítulo do CTA Final'],
            ['key' => 'cta_button_text', 'value' => 'Nos conte a sua história', 'group' => 'cta', 'type' => 'text', 'label' => 'Texto do Botão CTA'],

            // Contact & Social
            ['key' => 'contact_whatsapp', 'value' => '5567981530042', 'group' => 'contact', 'type' => 'text', 'label' => 'Número do WhatsApp'],
            ['key' => 'contact_email', 'value' => 'contato@estudionorra.com', 'group' => 'contact', 'type' => 'text', 'label' => 'E-mail de Contato'],

            // SEO
            ['key' => 'seo_title', 'value' => 'Estúdio Norra | Design e Desenvolvimento Web de Alto Padrão', 'group' => 'seo', 'type' => 'text', 'label' => 'Título SEO'],
            ['key' => 'seo_description', 'value' => 'Estúdio de design e engenharia digital focado em websites modernos, interfaces imersivas, modelagem 3D e experiências exclusivas para marcas que querem liderar seu mercado.', 'group' => 'seo', 'type' => 'textarea', 'label' => 'Descrição SEO'],
            ['key' => 'seo_keywords', 'value' => 'estúdio norra, web design, desenvolvimento web, design 3d, sites responsivos, websites modernos, interfaces de alto padrão', 'group' => 'seo', 'type' => 'textarea', 'label' => 'Palavras-chave SEO'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }

    private function seedHeroSlides(): void
    {
        $slides = [
            [
                'title' => 'Hub Arquitetura',
                'subtitle' => 'Design & Desenvolvimento Web',
                'image_path' => 'projects/1783454102263-hub.webp',
                'badge_text' => 'Web Design',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Nog Arquitetura',
                'subtitle' => 'Identidade Visual & Plataforma',
                'image_path' => 'projects/1783548230799-NOG-ARQUITETURA.webp',
                'badge_text' => 'Web Design',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Projeto Meta',
                'subtitle' => 'Web Experience Global',
                'image_path' => 'projects/1783538518016-SITE-PROJETO-META.webp',
                'badge_text' => 'Web Design',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($slides as $slide) {
            HeroSlide::updateOrCreate(['image_path' => $slide['image_path']], $slide);
        }
    }

    private function seedServices(): void
    {
        $services = [
            [
                'order_num' => '01',
                'title' => 'Web Design',
                'category' => 'Interface & Experiência',
                'description' => 'Criamos websites modernos e pensados para transmitir a profundidade e o propósito da sua empresa, transformando, através de uma experiência, a maneira como a sua marca é vista.',
                'deliverables' => [
                    'Figma',
                    'Inkscape',
                    'Penpot',
                    'Illustrator',
                    'Photoshop',
                    'Affinity Designer',
                ],
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'order_num' => '02',
                'title' => 'Programação',
                'category' => 'Engenharia de Software',
                'description' => 'Engenharia de software que transforma ideias em soluções reais e eficientes através do código, de forma performática e escalável para crescer junto com o seu negócio.',
                'deliverables' => [
                    'Next.js',
                    'TypeScript',
                    'TailwindCSS',
                    'Prisma',
                ],
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'order_num' => '03',
                'title' => '3D & Motion',
                'category' => 'Imersão & Interatividade',
                'description' => 'Traduzimos conceitos e ideias em produtos digitais tangíveis através de modelagem 3D e animação, com camadas de interatividade que conectam sua marca ao público de forma mais imersiva.',
                'deliverables' => [
                    'Blender',
                    'Three.js',
                    'Spline',
                    'Godot',
                    'DaVinci Resolve',
                ],
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        Service::query()->whereNotIn('title', ['Web Design', 'Programação', '3D & Motion'])->delete();

        foreach ($services as $service) {
            Service::updateOrCreate(['order_num' => $service['order_num']], $service);
        }
    }

    private function seedProjects(): void
    {
        $projects = [
            [
                'title' => 'Hub Arquitetura',
                'slug' => 'hub-arquitetura',
                'client' => 'Hub Arquitetura',
                'year' => '2026',
                'category' => 'Web Site',
                'short_description' => 'Website imersivo desenvolvido para o renomado escritório Hub Arquitetura, valorizando fotografia editorial, espacialidade e arquitetura contemporânea.',
                'full_description' => 'O projeto da Hub Arquitetura demandou uma experiência digital minimalista, na qual cada imagem pudesse respirar. Construímos uma navegação fluida, transições sutis e uma tipografia precisa que traduzem a sofisticação das obras do escritório.',
                'cover_image' => 'projects/1783454102263-hub.webp',
                'mockup_image' => 'projects/1775242588592-Macbook_Air_M2_Mockup_3.webp',
                'tags' => ['Web Design', 'Frontend', 'Arquitetura', 'Minimalismo'],
                'link_url' => null,
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Nog Arquitetura',
                'slug' => 'nog-arquitetura',
                'client' => 'Nog Arquitetura',
                'year' => '2026',
                'category' => 'Web Site',
                'short_description' => 'Plataforma digital com curadoria fotográfica imersiva e estética minimalista para estúdio de arquitetura e urbanismo.',
                'full_description' => 'Desenvolvido para valorizar a escala e a iluminação dos projetos do estúdio Nog, o site une grid rigoroso a uma experiência fluida tanto no desktop quanto em dispositivos móveis.',
                'cover_image' => 'projects/1783548230799-NOG-ARQUITETURA.webp',
                'mockup_image' => 'projects/1783614250577-MOCKUP-NOG.webp',
                'tags' => ['UI/UX', 'Identidade Visual', 'Performance', 'Arquitetura'],
                'link_url' => null,
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'BHLA Arquitetura',
                'slug' => 'bhla-arquitetura',
                'client' => 'BHLA Arquitetura',
                'year' => '2026',
                'category' => 'Web Site',
                'short_description' => 'Presença digital sofisticada destacando traços limpos, geometria e excelência técnica em projetos residenciais de alto padrão.',
                'full_description' => 'A BHLA precisava de uma presença institucional marcante para atender clientes de altíssimo padrão. Estruturamos uma galeria rica em detalhes e acabamentos gráficos primorosos.',
                'cover_image' => 'projects/1783533747011-BHLA-ARQUITETURA.webp',
                'mockup_image' => 'projects/1775597239863-MOCKUP-BHLA-ARQ.webp',
                'tags' => ['Web Site', 'Branding', 'Estética Minimalista'],
                'link_url' => null,
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Projeto Meta',
                'slug' => 'projeto-meta',
                'client' => 'Projeto Meta',
                'year' => '2026',
                'category' => 'Web Site',
                'short_description' => 'Plataforma de conexão e engajamento humanitário desenvolvida para uma iniciativa missionária no Quênia, com design acolhedor e responsivo.',
                'full_description' => 'Com narrativa visual tocante e navegação centrada nas histórias reais, o site do Projeto Meta facilita o apoio internacional e amplifica a transparência das ações no continente africano.',
                'cover_image' => 'projects/1783538518016-SITE-PROJETO-META.webp',
                'mockup_image' => 'projects/1775597125792-MOCKUP-PROJETO-META.webp',
                'tags' => ['Web Design', 'Design Responsivo', 'Impacto Social'],
                'link_url' => null,
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Yu-Gi-Oh Experience',
                'slug' => 'yu-gi-oh',
                'client' => 'Yu-Gi-Oh Community',
                'year' => '2025',
                'category' => '3D & Motion',
                'short_description' => 'Interface interativa e landing page com modelagem 3D, estética cyberpunk retrô e experiência interativa de alta imersão.',
                'full_description' => 'Projeto experimental e comunitário com rica composição 3D, efeitos de iluminação dinâmica e experiência visual cativante para fãs do clássico jogo de cartas.',
                'cover_image' => 'projects/1783962164019-SITEE-YUGIOH.webp',
                'mockup_image' => 'projects/1783961591648-Minimalist-MacBook-Pro-on-Textured-Boucle-Sofa-PSD-Mockup.webp',
                'tags' => ['3D Art', 'UI Interativa', 'Motion'],
                'link_url' => null,
                'is_featured' => false,
                'sort_order' => 5,
            ],
            [
                'title' => 'Clínica Amanda Mazzo',
                'slug' => 'amanda-mazzo',
                'client' => 'Clínica Amanda Mazzo',
                'year' => '2026',
                'category' => 'Web Site',
                'short_description' => 'Website elegante para clínica de estética avançada, combinando suavidade, clareza visual e foco em agendamentos.',
                'full_description' => 'Criado para transmitir tranquilidade e rigor profissional aos pacientes, unindo fotos ambientadas, descrição detalhada de procedimentos e integração direta ao WhatsApp.',
                'cover_image' => 'projects/1783538884324-Amanda-Mazzo.webp',
                'mockup_image' => 'projects/1775597266512-MOCKUP-ESTETICA.webp',
                'tags' => ['Saúde & Estética', 'Landing Page', 'Conversão'],
                'link_url' => null,
                'is_featured' => false,
                'sort_order' => 6,
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(['slug' => $project['slug']], $project);
        }
    }

    private function seedJourneySteps(): void
    {
        $steps = [
            [
                'step_num' => '01',
                'title' => 'Etapa 1',
                'subtitle' => null,
                'description' => 'Começamos o projeto mergulhando profundamento na marca, entendendo seu posicionamento e o que faz ela única, criando uma narrativa estratégica que conecta o usuário.',
                'deliverables' => null,
                'image_path' => 'storage/journey-stage-1.jpg',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'step_num' => '02',
                'title' => 'Etapa 2',
                'subtitle' => null,
                'description' => 'Com a narrativa estratégica definida iniciamos o desenvolvimento par criar um website premium, que engaja o usuário a se conectar com a marca e agir.',
                'deliverables' => null,
                'image_path' => 'about/1784131478057-NOG-ARQUITETURA.webp',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'step_num' => '03',
                'title' => 'Etapa 3',
                'subtitle' => null,
                'description' => 'Seu website é lançado na web, unindo estratégia e sofisticação, atraindo os clientes ideais, posicionando a sua marca e crescendo com você.',
                'deliverables' => null,
                'image_path' => 'about/1775587045202-SITE-BHLA.webp',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        JourneyStep::whereNotIn('step_num', ['01', '02', '03'])->delete();

        foreach ($steps as $step) {
            JourneyStep::updateOrCreate(['step_num' => $step['step_num']], $step);
        }
    }

    private function seedFaqs(): void
    {
        $faqs = [
            [
                'question' => 'Quanto tempo leva para desenvolver um projeto de website?',
                'answer' => 'O prazo varia de acordo com o escopo e complexidade do projeto. Landing pages e websites institucionais levam tipicamente de 2 a 4 semanas, desde o diagnóstico inicial e prototipagem até o deploy e testes finais.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Vocês realizam a configuração da hospedagem e domínio?',
                'answer' => 'Sim. Apoiamos na escolha e contratação do domínio e configuramos todo o ambiente no seu servidor de preferência (como Hostinger, VPS ou Cloud), com certificado SSL ativo, cache configurado e máxima segurança.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Consigo atualizar o conteúdo do site sozinho após o lançamento?',
                'answer' => 'Com certeza. Seu site conta com o Filament CMS, um painel administrativo intuitivo e poderoso onde você pode editar textos, fotos, adicionar novos projetos e gerenciar mensagens de contato sem depender de desenvolvedores.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'question' => 'Como funciona a estrutura de pagamento?',
                'answer' => 'Formatamos condições acessíveis para o seu fluxo de caixa, habitualmente com uma entrada no aceite do projeto e parcelas distribuídas entre a aprovação da prototipagem e a entrega final.',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'question' => 'O site já vem adaptado para smartphones e otimizado para o Google (SEO)?',
                'answer' => 'Sim! Desenvolvemos com mentalidade mobile-first e padrões modernos da web: HTML5 semântico, metatags completas, OpenGraph para redes sociais, sitemap indexável e velocidade máxima para excelente pontuação no Core Web Vitals.',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'question' => 'Qual é o primeiro passo para iniciarmos um projeto?',
                'answer' => 'Basta clicar no botão "Fale Conosco" ou preencher o formulário no final da página. Entraremos em contato em até 24 horas para entender seu objetivo e apresentar uma proposta personalizada.',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(['question' => $faq['question']], $faq);
        }
    }

    private function seedSocialLinks(): void
    {
        $links = [
            [
                'platform' => 'Instagram',
                'label' => 'Instagram',
                'url' => 'https://www.instagram.com/estudionorra/',
                'icon' => 'instagram',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'platform' => 'LinkedIn',
                'label' => 'LinkedIn',
                'url' => 'https://www.linkedin.com/company/estudio-norra/',
                'icon' => 'linkedin',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'platform' => 'WhatsApp',
                'label' => 'WhatsApp',
                'url' => 'https://wa.me/5567981530042',
                'icon' => 'whatsapp',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($links as $link) {
            SocialLink::updateOrCreate(['platform' => $link['platform']], $link);
        }
    }
}
