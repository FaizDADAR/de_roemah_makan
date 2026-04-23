# Code Snippets & Logic

## 1. AJAX Order Recording (Frontend)
Snippet ini digunakan di `checkout.blade.php` untuk memastikan data tersimpan sebelum redirect ke WhatsApp.

```javascript
// Record the order first via AJAX
const response = await fetch('{{ route("checkout.store") }}', {
    method: 'POST',
    headers: { 
        'Content-Type': 'application/json', 
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json' 
    },
    body: JSON.stringify({
        customer_name: name,
        phone: phone,
        note: `Alamat: ${address}\nCatatan: ${note}`
    })
});

const result = await response.json();
const waUrl = `https://wa.me/${adminPhone}?text=Order #${result.order_id}...`;
```

## 2. Dynamic Image Rendering (Admin)
Mengingat keterbatasan `ImageColumn` pada path publik non-storage, kita menggunakan `TextColumn` dengan HTML String:

```php
Tables\Columns\TextColumn::make('image_url')
    ->label('Foto')
    ->formatStateUsing(fn ($state) => new HtmlString("<img src='".asset($state)."' class='w-10 h-10 rounded-full object-cover shadow-sm'>")),
```

## 3. Delivery Reminder Logic
Pengecekan H-3 pengantaran catering:

```php
->description(fn ($record) => 
    now()->diffInDays($record->date, false) <= 3 && now()->diffInDays($record->date, false) >= 0 
    ? '⏰ Segera diantar!' 
    : null
)
```
