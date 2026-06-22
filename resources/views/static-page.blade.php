@include('includes.header')
<style>
/* ── Policy/Static Page ── */
.policy-container { width:100%; overflow-x:hidden; background-color: #faf9f7; padding: 60px 20px; }
.policy-page { max-width: 900px; margin: 0 auto; background: #fff; padding: 40px 50px; border-radius: 16px; box-shadow: 0 8px 30px rgba(0,0,0,0.04); color: #000; }
.policy-title { font-size: 32px; font-weight: 800; color: #000; margin-bottom: 30px; text-align: center; border-bottom: 2px solid #f0f0f0; padding-bottom: 20px; }
.policy-content h2 { font-size: 22px; font-weight: 700; color: #000; margin-top: 30px; margin-bottom: 15px; }
.policy-content h3 { font-size: 18px; font-weight: 600; color: #000; margin-top: 20px; margin-bottom: 10px; }
.policy-content p { font-size: 15px; color: #000; line-height: 1.7; margin-bottom: 15px; }
.policy-content ul, .policy-content ol { margin-left: 20px; margin-bottom: 15px; color: #000; font-size: 15px; line-height: 1.7; }
.policy-content li { margin-bottom: 8px; }
.policy-content strong { color: #000; font-weight: 700; }
.policy-alert { background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px 20px; margin-bottom: 20px; border-radius: 4px; }
.policy-alert p { margin: 0; color: #000; font-weight: 600; }

@media (max-width: 768px) {
    .policy-page { padding: 30px 20px; }
    .policy-title { font-size: 26px; }
}
</style>

<div class="policy-container">
    <div class="policy-page">
        <h1 class="policy-title">{{ $page->title ?: $page->name }}</h1>
        
        <div class="policy-content">
            {!! $page->content !!}
        </div>
    </div>
</div>
@include('includes.footer')
