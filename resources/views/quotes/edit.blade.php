@extends('layouts.app')
@section('title', 'Edit Quote')

@section('content')
    <div class="max-w-4xl mx-auto flex flex-col items-stretch space-y-6">
        <div class="mb-6 flex flex-col gap-2 mt-4">
            <a href="{{ route('quotes.index') }}"
                class="text-slate-500 text-sm font-medium hover:text-slate-900 hover:underline inline-flex items-center gap-2 transition-colors w-fit">
                <i class="fa-solid fa-arrow-left"></i> Back to Quotes
            </a>
            <h2 class="text-3xl font-bold tracking-tight text-slate-900 border-b-4 border-slate-900 pb-2 w-fit">
                Edit Quote
            </h2>
        </div>

        <form id="quote-form" action="{{ route('quotes.update', $quote->id) }}" method="POST"
            class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 overflow-visible border border-slate-100 flex flex-col space-y-0">
            @csrf
            @method('PUT')

            <!-- Header Section -->
            <div class="p-8 border-b border-slate-100 bg-slate-50/50 rounded-t-2xl">
                <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-3">
                    <div class="w-8 h-8 rounded bg-brand-100 text-brand-600 flex items-center justify-center text-sm"><i
                            class="fa-solid fa-user"></i></div> Customer & Company Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Customer Contact Name *</label>
                        <input type="text" name="customer_name" required
                            value="{{ old('customer_name', $quote->customer_name) }}"
                            class="w-full rounded-lg border-slate-200 shadow-sm focus:border-brand-500 focus:ring-brand-500 py-2.5 px-4 transition-all duration-200 bg-white"
                            placeholder="e.g. John Doe">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Company Name *</label>
                        <input type="text" name="company_name" required
                            value="{{ old('company_name', $quote->company_name) }}"
                            class="w-full rounded-lg border-slate-200 shadow-sm focus:border-brand-500 focus:ring-brand-500 py-2.5 px-4 transition-all duration-200 bg-white"
                            placeholder="e.g. General Motors">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Company Logo (Optional)</label>
                        <div class="flex items-center gap-4">
                            <input type="hidden" name="company_logo_base64" id="company_logo_base64">
                            <input type="file" id="company_logo_input" accept="image/*"
                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 transition-all border border-slate-200 rounded-lg bg-white" />
                            <div id="logo-preview-container" class="{{ $quote->company_logo ? '' : 'hidden' }} relative">
                                <img id="logo-preview" src="{{ $quote->company_logo ? url($quote->company_logo) : '#' }}"
                                    class="h-12 w-auto object-contain border rounded shadow-sm">
                                <button type="button" id="remove-logo"
                                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-600"><i
                                        class="fa-solid fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $quote->email) }}"
                            class="w-full rounded-lg border-slate-200 shadow-sm focus:border-brand-500 focus:ring-brand-500 py-2.5 px-4 transition-all duration-200 bg-white"
                            placeholder="contact@company.com">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $quote->phone) }}"
                            class="w-full rounded-lg border-slate-200 shadow-sm focus:border-brand-500 focus:ring-brand-500 py-2.5 px-4 transition-all duration-200 bg-white"
                            placeholder="(555) 123-4567">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Address</label>
                        <input type="text" name="address" value="{{ old('address', $quote->address) }}"
                            class="w-full rounded-lg border-slate-200 shadow-sm focus:border-brand-500 focus:ring-brand-500 py-2.5 px-4 transition-all duration-200 bg-white"
                            placeholder="123 Main St">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">City</label>
                        <input type="text" name="city" value="{{ old('city', $quote->city) }}"
                            class="w-full rounded-lg border-slate-200 shadow-sm focus:border-brand-500 focus:ring-brand-500 py-2.5 px-4 transition-all duration-200 bg-white"
                            placeholder="Detroit">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">State</label>
                            <input type="text" name="state" value="{{ old('state', $quote->state) }}"
                                class="w-full rounded-lg border-slate-200 shadow-sm focus:border-brand-500 focus:ring-brand-500 py-2.5 px-4 transition-all duration-200 bg-white"
                                placeholder="MI">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">PIN / Zip</label>
                            <input type="text" name="pincode" value="{{ old('pincode', $quote->pincode) }}"
                                class="w-full rounded-lg border-slate-200 shadow-sm focus:border-brand-500 focus:ring-brand-500 py-2.5 px-4 transition-all duration-200 bg-white"
                                placeholder="48201">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Quote Status</label>
                        <select name="status"
                            class="w-full rounded-lg border-slate-200 shadow-sm focus:border-brand-500 focus:ring-brand-500 py-2.5 px-4 transition-all duration-200 bg-white">
                            <option value="Active" {{ $quote->status === 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Draft" {{ $quote->status === 'Draft' ? 'selected' : '' }}>Draft</option>
                            <option value="Sent" {{ $quote->status === 'Sent' ? 'selected' : '' }}>Sent</option>
                            <option value="Accepted" {{ $quote->status === 'Accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="Rejected" {{ $quote->status === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Internal Notes (Optional)</label>
                        <textarea name="notes" rows="3"
                            class="w-full rounded-lg border-slate-200 shadow-sm focus:border-brand-500 focus:ring-brand-500 py-2.5 px-4 transition-all duration-200 bg-white"
                            placeholder="Add any internal notes about this quote...">{{ old('notes', $quote->notes) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Products Section -->
            <div class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-slate-800 flex items-center gap-3">
                        <div class="w-8 h-8 rounded bg-brand-100 text-brand-600 flex items-center justify-center text-sm"><i
                                class="fa-solid fa-box"></i></div> Selected Products
                    </h3>
                    <button type="button" id="add-item"
                        class="bg-indigo-50 text-indigo-600 hover:bg-indigo-100 font-bold px-4 py-2 rounded-lg transition-colors border border-indigo-200 text-sm flex items-center gap-2"><i
                            class="fa-solid fa-plus"></i> Add Row</button>
                </div>

                <div id="items-container" class="space-y-4 min-h-[150px]">
                    <!-- Example Row -->
                    <div class="text-center text-slate-400 py-8" id="empty-state">
                        <i class="fa-solid fa-dolly text-4xl text-slate-200 mb-3"></i>
                        <p>No products added yet.</p>
                    </div>
                </div>
            </div>

            <!-- Submission -->
            <div class="bg-slate-50 p-6 border-t border-slate-100 flex justify-end gap-4 rounded-b-2xl">
                <a href="{{ route('quotes.index') }}"
                    class="px-6 py-2.5 rounded-lg border border-slate-300 font-semibold text-slate-600 hover:bg-slate-100 hover:text-slate-800 transition-colors">Cancel</a>
                <button type="submit" id="submit-btn"
                    class="bg-slate-900 hover:bg-slate-800 w-full sm:w-auto text-white font-bold py-2.5 px-8 rounded-lg shadow min-w-[160px] flex items-center justify-center transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                    Generate/Update Proposal
                </button>
            </div>
        </form>
    </div>

    <!-- Row Template -->
    <template id="item-template">
        <div
            class="item-row relative bg-white border border-slate-200 p-5 rounded-xl shadow-sm hover:shadow transition-shadow group animate-fade-in flex gap-4">
            <div class="flex-grow grid grid-cols-1 sm:grid-cols-12 gap-5 items-start">
                <div class="sm:col-span-5">
                    <label class="block text-xs uppercase tracking-wide font-bold text-slate-400 mb-2">Product *</label>
                    <div class="relative">
                        <select name="items[__INDEX__][product_id]" required
                            class="product-select appearance-none w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-lg focus:ring-brand-500 focus:border-brand-500 block p-2.5 font-medium transition-colors">
                            <option value="">-- Choose Product --</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>

                <div class="sm:col-span-5">
                    <label class="block text-xs uppercase tracking-wide font-bold text-slate-400 mb-2 text-left">Price Type
                        *</label>
                    <div class="relative">
                        <div class="price-spinner absolute left-3 top-3 text-brand-500 hidden z-10">
                            <i class="fa-solid fa-circle-notch fa-spin text-sm"></i>
                        </div>
                        <select name="items[__INDEX__][price_id]" required
                            class="price-select appearance-none w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-lg focus:ring-brand-500 focus:border-brand-500 block p-2.5 font-medium transition-colors disabled:opacity-50 disabled:bg-slate-100"
                            disabled>
                            <option value="">-- Select Product First --</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs uppercase tracking-wide font-bold text-slate-400 mb-2">Qty</label>
                    <input type="number" name="items[__INDEX__][quantity]" required min="1" value="1"
                        class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-brand-500 focus:border-brand-500 block w-full p-2.5 font-bold text-center">
                </div>
            </div>

            <div class="flex items-center pt-6">
                <button type="button"
                    class="remove-item text-slate-300 hover:text-red-500 hover:bg-red-50 w-10 h-10 rounded-lg flex items-center justify-center transition-all bg-slate-50 tooltip"
                    title="Remove Row">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        </div>
    </template>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let itemIndex = 0;
                const container = document.getElementById('items-container');
                const template = document.getElementById('item-template');
                const emptyState = document.getElementById('empty-state');
                const addButton = document.getElementById('add-item');
                const form = document.getElementById('quote-form');

                let productsList = [];

                // Handle Logo Upload Preview & Base64
                const logoInput = document.getElementById('company_logo_input');
                const logoBase64 = document.getElementById('company_logo_base64');
                const logoPreviewContainer = document.getElementById('logo-preview-container');
                const logoPreview = document.getElementById('logo-preview');
                const removeLogoBtn = document.getElementById('remove-logo');

                logoInput.addEventListener('change', function (e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (evt) {
                            logoBase64.value = evt.target.result;
                            logoPreview.src = evt.target.result;
                            logoPreviewContainer.classList.remove('hidden');
                        }
                        reader.readAsDataURL(file);
                    } else {
                        clearLogo();
                    }
                });

                removeLogoBtn.addEventListener('click', clearLogo);

                function clearLogo() {
                    logoInput.value = '';
                    logoBase64.value = '';
                    logoPreview.src = '#';
                    logoPreviewContainer.classList.add('hidden');
                }

                // Initial DB Items
                const initialItems = @json($quote->items);

                // Fetch initial products
                fetch('/api/products')
                    .then(res => res.json())
                    .then(data => {
                        productsList = data;
                        if (initialItems.length > 0) {
                            initialItems.forEach(item => {
                                addRow(item.product_id, item.price_id, item.quantity);
                            });
                        } else {
                            addRow();
                        }
                    })
                    .catch(err => {
                        console.error('Failed to load products');
                        alert('Failed to load products.');
                    });

                function addRow(initProductId = null, initPriceId = null, initQty = 1) {
                    if (emptyState) emptyState.style.display = 'none';

                    const clone = template.content.cloneNode(true);
                    const row = clone.querySelector('.item-row');

                    // Update names
                    const selects = row.querySelectorAll('select, input');
                    selects.forEach(el => {
                        el.name = el.name.replace('__INDEX__', itemIndex);
                    });

                    // Populate qty if init
                    row.querySelector('input[type="number"]').value = initQty;

                    // Populate products dropdown
                    const productSelect = row.querySelector('.product-select');
                    productsList.forEach(product => {
                        const opt = document.createElement('option');
                        opt.value = product.id;
                        opt.textContent = product.name;
                        productSelect.appendChild(opt);
                    });

                    // Handle Product Selection Change -> Load Prices
                    productSelect.addEventListener('change', function (e) {
                        loadPrices(e.target.value, row);
                    });

                    function loadPrices(pId, rowElem, selectedPriceId = null) {
                        const priceSelect = rowElem.querySelector('.price-select');
                        const spinner = rowElem.querySelector('.price-spinner');

                        priceSelect.innerHTML = '<option value="">-- Choose Price Type --</option>';
                        priceSelect.disabled = true;

                        if (!pId) return;

                        spinner.classList.remove('hidden');

                        fetch(`/api/products/${pId}/prices`)
                            .then(res => res.json())
                            .then(prices => {
                                spinner.classList.add('hidden');
                                priceSelect.disabled = false;

                                prices.forEach(price => {
                                    const opt = document.createElement('option');
                                    opt.value = price.id;
                                    let text = `${price.type}`;
                                    if (price.type === 'Fixed') text += ` ($${Number(price.setup_fee).toFixed(0)})`;
                                    else text += ` ($${Number(price.setup_fee).toFixed(0)} Setup, $${Number(price.monthly_fee).toFixed(0)}/mo x ${price.term_months}mo)`;
                                    opt.textContent = text;
                                    priceSelect.appendChild(opt);
                                });

                                if (selectedPriceId) {
                                    priceSelect.value = selectedPriceId;
                                }
                            })
                            .catch(() => {
                                spinner.classList.add('hidden');
                            });
                    }

                    if (initProductId) {
                        productSelect.value = initProductId;
                        loadPrices(initProductId, row, initPriceId);
                    }

                    // Remove row logic
                    row.querySelector('.remove-item').addEventListener('click', function () {
                        row.style.opacity = '0';
                        row.style.transform = 'translateY(-10px)';
                        setTimeout(() => {
                            row.remove();
                            if (container.querySelectorAll('.item-row').length === 0) {
                                if (emptyState) emptyState.style.display = 'block';
                            }
                        }, 200);
                    });

                    container.appendChild(row);
                    itemIndex++;
                }

                addButton.addEventListener('click', addRow);

                // Form Submission
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const rows = container.querySelectorAll('.item-row');
                    if (rows.length === 0) {
                        alert('Please add at least one product to the quote.');
                        return;
                    }

                    const submitBtn = document.getElementById('submit-btn');
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin mr-2"></i> Generating/Updating...';

                    const formData = new FormData(form);
                    const data = {};
                    formData.forEach((value, key) => data[key] = value);

                    // Let's rely on standard JSON fetch instead
                    const rawItems = [];
                    container.querySelectorAll('.item-row').forEach((row, i) => {
                        const pSelect = row.querySelector('.product-select');
                        const prSelect = row.querySelector('.price-select');
                        const qInput = row.querySelector('input[type="number"]');

                        if (pSelect.value && prSelect.value) {
                            rawItems.push({
                                product_id: pSelect.value,
                                price_id: prSelect.value,
                                quantity: qInput.value
                            });
                        }
                    });

                    const fetchBody = {
                        customer_name: formData.get('customer_name'),
                        company_name: formData.get('company_name'),
                        company_logo_base64: formData.get('company_logo_base64'),
                        email: formData.get('email'),
                        phone: formData.get('phone'),
                        address: formData.get('address'),
                        city: formData.get('city'),
                        state: formData.get('state'),
                        pincode: formData.get('pincode'),
                        status: formData.get('status'),
                        notes: formData.get('notes'),
                        items: rawItems
                    };

                    fetch('{{ route('quotes.update', $quote->id) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify({ ...fetchBody, _method: 'PUT' })
                    })
                        .then(async res => {
                            if (!res.ok) {
                                const errData = await res.json().catch(() => ({}));
                                let errMsg = 'Something went wrong. Check inputs.';
                                if (errData && errData.errors) {
                                    errMsg = Object.values(errData.errors).flat().join('\n');
                                } else if (errData && errData.message) {
                                    errMsg = errData.message;
                                }
                                throw new Error(errMsg);
                            }
                            return res.json();
                        })
                        .then(res => {
                            if (res.success) {
                                window.location.href = res.redirect;
                            } else {
                                alert('Something went wrong. Check inputs.');
                                submitBtn.disabled = false;
                                submitBtn.innerHTML = 'Generate/Update Proposal';
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Failed to update quote:\n\n' + err.message);
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = 'Generate/Update Proposal';
                        });
                });
            });
        </script>
    @endpush
@endsection