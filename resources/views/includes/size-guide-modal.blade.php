<style>
    .size-guide-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0,0,0,0.6);
        z-index: 10000; /* Higher than quickview */
        display: none;
        align-items: center;
        justify-content: center;
        font-family: 'Poppins', sans-serif;
    }

    .size-guide-overlay.active {
        display: flex;
    }

    .size-guide-modal {
        background: #fff;
        width: 90%;
        max-width: 600px;
        border-radius: 4px;
        position: relative;
        padding: 30px;
        animation: modalFadeIn 0.3s ease;
        max-height: 90vh;
        overflow-y: auto;
    }

    .size-guide-close {
        position: absolute;
        top: 15px;
        right: 15px;
        background: #fff;
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        cursor: pointer;
        z-index: 10;
        color: #000;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        line-height: 1;
    }

    .size-guide-close:hover {
        background: #f0f0f0;
    }

    .size-guide-title {
        font-size: 24px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 20px;
        color: #000;
    }

    .size-guide-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        text-align: center;
    }

    .size-guide-table th {
        background: #f5f5f5;
        padding: 12px;
        font-weight: 600;
        border: 1px solid #ddd;
    }

    .size-guide-table td {
        padding: 12px;
        border: 1px solid #ddd;
        color: #333;
    }

    .size-guide-note {
        font-size: 13px;
        color: #666;
        text-align: center;
        margin-top: 15px;
    }
</style>

<div class="size-guide-overlay" id="sizeGuideModal" onclick="closeSizeGuide(event)">
    <div class="size-guide-modal" onclick="event.stopPropagation()">
        <button class="size-guide-close" onclick="closeSizeGuide(event)">&times;</button>
        <h2 class="size-guide-title">Size Guide</h2>
        <div style="overflow-x: auto;">
            <table class="size-guide-table">
                <thead>
                    <tr>
                        <th>Size</th>
                        <th>Chest (inches)</th>
                        <th>Waist (inches)</th>
                        <th>Hips (inches)</th>
                        <th>Length (inches)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Small (S)</td>
                        <td>36"</td>
                        <td>30"</td>
                        <td>38"</td>
                        <td>38"</td>
                    </tr>
                    <tr>
                        <td>Medium (M)</td>
                        <td>38"</td>
                        <td>32"</td>
                        <td>40"</td>
                        <td>39"</td>
                    </tr>
                    <tr>
                        <td>Large (L)</td>
                        <td>40"</td>
                        <td>34"</td>
                        <td>42"</td>
                        <td>40"</td>
                    </tr>
                    <tr>
                        <td>Extra Large (XL)</td>
                        <td>42"</td>
                        <td>36"</td>
                        <td>44"</td>
                        <td>41"</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="size-guide-note">* Measurements are approximate and may vary slightly depending on the style and fabric.</p>
    </div>
</div>

<script>
    function openSizeGuide(e) {
        if(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        document.getElementById('sizeGuideModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeSizeGuide(e) {
        if(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        document.getElementById('sizeGuideModal').classList.remove('active');
        document.body.style.overflow = '';
    }
</script>
