@include('includes.header')
<style>
/* ── FAQ Page ── */
.faq-container { width:100%; overflow-x:hidden; background-color: #fff; padding: 40px 20px 80px; font-family: 'Inter', sans-serif; }
.faq-breadcrumb { max-width: 900px; margin: 0 auto 40px; display: flex; align-items: center; gap: 8px; font-size: 14px; color: #555; }
.faq-breadcrumb a { color: #555; text-decoration: none; display: flex; align-items: center; gap: 5px; }
.faq-breadcrumb a:hover { color: #000; }
.faq-header { text-align: center; max-width: 700px; margin: 0 auto 50px; }
.faq-header h1 { font-size: 32px; font-weight: 800; color: #000; margin-bottom: 15px; }
.faq-header p { font-size: 15px; color: #555; }
.faq-list { max-width: 900px; margin: 0 auto; display: flex; flex-direction: column; gap: 15px; }
.faq-item { border: 1px solid #eaeaea; border-radius: 8px; overflow: hidden; }
.faq-question { width: 100%; text-align: left; background: #fff; border: none; padding: 20px 25px; font-size: 15px; color: #333; font-weight: 500; cursor: pointer; display: flex; justify-content: space-between; align-items: center; transition: background 0.3s; }
.faq-question:hover { background: #fafafa; }
.faq-question svg { transition: transform 0.3s; }
.faq-item.active .faq-question svg { transform: rotate(45deg); }
.faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out, padding 0.3s ease; background: #fff; padding: 0 25px; color: #555; font-size: 14.5px; line-height: 1.6; }
.faq-item.active .faq-answer { max-height: 500px; padding: 25px 25px 20px; }
</style>

<div class="faq-container">
    <div class="faq-breadcrumb">
        <a href="{{ route('home') }}">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            Home
        </a>
        <span>›</span>
        <span>FAQ's</span>
    </div>
    
    <div class="faq-header">
        <h1>Frequently Asked Questions</h1>
        <p>Find quick answers to the most common questions about orders, delivery, and returns.</p>
    </div>

    <div class="faq-list">
        <div class="faq-item">
            <button class="faq-question">What is the delivery Time? <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></button>
            <div class="faq-answer"><p>Delivery takes 3-7 business days for domestic orders and 7-15 business days for international orders.</p></div>
        </div>
        <div class="faq-item">
            <button class="faq-question">What if the product color varies? <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></button>
            <div class="faq-answer"><p>Minor color variations may occur due to lighting and screen settings. This is completely normal.</p></div>
        </div>
        <div class="faq-item">
            <button class="faq-question">Can I modify my order after placing it? <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></button>
            <div class="faq-answer"><p>Orders can only be modified before they enter the processing and shipping stage. Please contact customer support immediately.</p></div>
        </div>
        <div class="faq-item">
            <button class="faq-question">What payment methods do you accept? <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></button>
            <div class="faq-answer"><p>We accept Cash on Delivery (where applicable), Credit/Debit Cards, and Bank Transfers.</p></div>
        </div>
        <div class="faq-item">
            <button class="faq-question">How do I choose the right size? <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></button>
            <div class="faq-answer"><p>Please refer to our detailed size chart available on every product page to find your perfect fit.</p></div>
        </div>
        <div class="faq-item">
            <button class="faq-question">How long does delivery take? <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></button>
            <div class="faq-answer"><p>Within Pakistan, it takes 3-7 days. Internationally, it takes 7-15 days depending on the destination.</p></div>
        </div>
        <div class="faq-item">
            <button class="faq-question">How do I place an order? <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></button>
            <div class="faq-answer"><p>Simply browse our collections, add your desired items to the cart, and proceed to checkout.</p></div>
        </div>
        <div class="faq-item">
            <button class="faq-question">Can I return my product? <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></button>
            <div class="faq-answer"><p>Yes, you can return or exchange eligible products within 3 working days of delivery. Refer to our Returns Policy for more details.</p></div>
        </div>
        <div class="faq-item">
            <button class="faq-question">How can I contact customer support? <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></button>
            <div class="faq-answer"><p>You can reach us via our Contact Us page, email, or our customer support phone line.</p></div>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.faq-question').forEach(button => {
    button.addEventListener('click', () => {
        const faqItem = button.parentElement;
        const isActive = faqItem.classList.contains('active');
        
        // Optional: close all other items
        document.querySelectorAll('.faq-item').forEach(item => {
            item.classList.remove('active');
        });
        
        if (!isActive) {
            faqItem.classList.add('active');
        }
    });
});
</script>

@include('includes.footer')
