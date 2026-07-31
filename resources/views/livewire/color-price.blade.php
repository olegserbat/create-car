<div>
    <!-- Поле с ценой цвета -->
    <div class="mb-3">
        <label for="color-price-field" class="form-label">Стоимость цвета</label>
        <input
            type="text"
            id="color-price-field"
            class="form-control bg-white"
            value="{{ $priceFormatted ?? '—' }}"
            readonly
            style="cursor: default;"
        >
    </div>
</div>
