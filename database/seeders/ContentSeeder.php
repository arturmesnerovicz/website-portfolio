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
            ['key' => 'hero_subtitle', 'value' => 'Ajudamos marcas consolidadas craindo uma experiência de website, que reflete aquilo que construíram e o que as tornam únicas.', 'group' => 'hero', 'type' => 'textarea', 'label' => 'Subtítulo do Hero'],
            ['key' => 'hero_cta_text', 'value' => 'Fale Conosco', 'group' => 'hero', 'type' => 'text', 'label' => 'Texto do Botão Hero'],
            ['key' => 'hero_badge_number', 'value' => '30+', 'group' => 'hero', 'type' => 'text', 'label' => 'Métrica do Hero'],
            ['key' => 'hero_badge_label', 'value' => 'marcas ajudadas', 'group' => 'hero', 'type' => 'text', 'label' => 'Legenda da Métrica Hero'],
            ['key' => 'hero_image_left', 'value' => 'hero-imac.png', 'group' => 'hero', 'type' => 'image', 'label' => 'Mockup Superior Esquerdo'],
            ['key' => 'hero_image_right', 'value' => 'hero-tablet.png', 'group' => 'hero', 'type' => 'image', 'label' => 'Mockup Superior Direito'],
            ['key' => 'hero_image_bottom_right', 'value' => 'hero-tablet-bottom.png', 'group' => 'hero', 'type' => 'image', 'label' => 'Mockup Inferior Direito'],

            // Manifesto Section
            ['key' => 'manifesto_headline', 'value' => "Acreditamos que grandes\nfundadores merecem uma\npresença digital a altura do\nque estão construindo.", 'group' => 'manifesto', 'type' => 'textarea', 'label' => 'Manchete do Manifesto'],
            ['key' => 'manifesto_p1', 'value' => 'Muitas empresas desenvolveram marcas incríveis, mas seu website não reflete isso ainda.', 'group' => 'manifesto', 'type' => 'textarea', 'label' => 'Primeiro Parágrafo do Manifesto'],
            ['key' => 'manifesto_metric_number', 'value' => '1k+', 'group' => 'manifesto', 'type' => 'text', 'label' => 'Métrica 1 - Número'],
            ['key' => 'manifesto_metric_label', 'value' => 'designs entregues', 'group' => 'manifesto', 'type' => 'text', 'label' => 'Métrica 1 - Legenda'],
            ['key' => 'manifesto_stat2_number', 'value' => '98%', 'group' => 'manifesto', 'type' => 'text', 'label' => 'Métrica 2 - Número'],
            ['key' => 'manifesto_stat2_label', 'value' => 'satisfação comprovada', 'group' => 'manifesto', 'type' => 'text', 'label' => 'Métrica 2 - Legenda'],
            ['key' => 'manifesto_stat3_number', 'value' => '10+', 'group' => 'manifesto', 'type' => 'text', 'label' => 'Métrica 3 - Número'],
            ['key' => 'manifesto_stat3_label', 'value' => 'anos de excelência', 'group' => 'manifesto', 'type' => 'text', 'label' => 'Métrica 3 - Legenda'],

            // Final CTA Section
            ['key' => 'cta_title', 'value' => 'VAMOS CRIAR UMA EXPERIÊNCIA QUE MOVE SUA MARCA', 'group' => 'cta', 'type' => 'text', 'label' => 'Título do CTA Final'],
            ['key' => 'cta_subtitle', 'value' => 'Conte-nos sobre a sua visão. Vamos estruturar a melhor solução de design e engenharia para o seu negócio.', 'group' => 'cta', 'type' => 'textarea', 'label' => 'Subtítulo do CTA Final'],
            ['key' => 'cta_button_text', 'value' => 'Nos conte a sua história', 'group' => 'cta', 'type' => 'text', 'label' => 'Texto do Botão CTA'],

            // Contact & Social
            ['key' => 'contact_whatsapp', 'value' => '5567981530042', 'group' => 'contact', 'type' => 'text', 'label' => 'Número do WhatsApp'],
            ['key' => 'contact_email', 'value' => 'contato@estudionorra.com', 'group' => 'contact', 'type' => 'text', 'label' => 'E-mail de Contato'],

            // SEO & Social Share
            ['key' => 'seo_title', 'value' => 'Estúdio Norra | Design e Desenvolvimento Web de Alto Padrão', 'group' => 'seo', 'type' => 'text', 'label' => 'Título SEO'],
            ['key' => 'seo_description', 'value' => 'Estúdio de design e engenharia digital focado em websites modernos, interfaces imersivas, modelagem 3D e experiências exclusivas para marcas que querem liderar seu mercado.', 'group' => 'seo', 'type' => 'textarea', 'label' => 'Descrição SEO'],
            ['key' => 'seo_keywords', 'value' => 'estúdio norra, web design, desenvolvimento web, design 3d, sites responsivos, websites modernos, interfaces de alto padrão', 'group' => 'seo', 'type' => 'textarea', 'label' => 'Palavras-chave SEO'],
            ['key' => 'og_image', 'value' => null, 'group' => 'seo', 'type' => 'image', 'label' => 'Imagem Open Graph (WhatsApp, LinkedIn, Redes Sociais)'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::firstOrCreate(['key' => $setting['key']], $setting);
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
            HeroSlide::firstOrCreate(['image_path' => $slide['image_path']], $slide);
        }
    }

    private function seedServices(): void
    {
        $services = [
            [
                'order_num' => '01',
                'title' => 'Website Development',
                'category' => 'Engineering & Web',
                'description' => 'Desenvolvimento de websites modernos, performáticos e escaláveis com arquitetura de software limpa.',
                'image' => 'services/website-development.png',
                'deliverables' => [
                    'Next.js',
                    'TypeScript',
                    'TailwindCSS',
                    'Laravel',
                ],
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'order_num' => '02',
                'title' => 'Website Design',
                'category' => 'Interface & UX/UI',
                'description' => 'Criação de interfaces digitais sofisticadas pensadas para transmitir o propósito e a essência da sua marca.',
                'image' => 'services/website-design.png',
                'deliverables' => [
                    'Figma',
                    'UI/UX Design',
                    'Design System',
                    'Prototyping',
                ],
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'order_num' => '03',
                'title' => 'Website Strategy',
                'category' => 'Growth & Positioning',
                'description' => 'Planejamento estratégico de navegação, conversão e jornada do usuário para transformar visitantes em clientes.',
                'image' => 'services/website-strategy.png',
                'deliverables' => [
                    'SEO',
                    'User Journey',
                    'Conversion Rate',
                    'Information Architecture',
                ],
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'order_num' => '04',
                'title' => 'Brand Strategy',
                'category' => 'Branding & Vision',
                'description' => 'Posicionamento estratégico e narrativa de marca para destacar sua empresa com autoridade e coerência no mercado.',
                'image' => 'services/brand-strategy.png',
                'deliverables' => [
                    'Brand Narrative',
                    'Tone of Voice',
                    'Market Positioning',
                    'Audience Research',
                ],
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'order_num' => '05',
                'title' => 'Visual Identity',
                'category' => 'Design & Identity',
                'description' => 'Sistemas visuais completos e memoráveis com logotipo, paleta cromática, tipografia e diretrizes de aplicação.',
                'image' => 'services/visual-identity.png',
                'deliverables' => [
                    'Logo Design',
                    'Typography',
                    'Color System',
                    'Brand Guidelines',
                ],
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

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
        ];

        foreach ($projects as $project) {
            Project::firstOrCreate(['slug' => $project['slug']], $project);
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

        foreach ($steps as $step) {
            JourneyStep::firstOrCreate(['step_num' => $step['step_num']], $step);
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
            Faq::firstOrCreate(['question' => $faq['question']], $faq);
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
            SocialLink::firstOrCreate(['platform' => $link['platform']], $link);
        }
    }
}
