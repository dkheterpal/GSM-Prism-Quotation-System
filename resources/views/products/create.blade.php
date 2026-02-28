@extends('layouts.app')
@section('title', 'Create Product')

@section('content')
    <div class="max-w-4xl mx-auto align-middle animate-fade-in" style="animation-delay: 0.1s;">
        <div class="mb-6 flex flex-col gap-2 mt-4">
            <a href="{{ route('products.index') }}"
                class="text-slate-500 text-sm font-medium hover:text-slate-900 hover:underline inline-flex items-center gap-2 transition-colors w-fit">
                <i class="fa-solid fa-arrow-left"></i> Back to Products
            </a>
            <h2 class="text-3xl font-bold tracking-tight text-slate-900 border-b-4 border-slate-900 pb-2 w-fit">
                Add New Product
            </h2>
        </div>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 overflow-visible border border-slate-100 flex flex-col space-y-0"
            onsubmit="this.querySelector('button[type=submit]').innerHTML='<i class=\'fa-solid fa-circle-notch fa-spin mr-2\'></i> Generating/Updating...'; this.querySelector('button[type=submit]').disabled=true;">
            @csrf

            <div class="p-8 border-b border-slate-100 bg-slate-50/50 rounded-t-2xl">
                <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-3">
                    <div class="w-8 h-8 rounded bg-slate-200 text-slate-600 flex items-center justify-center text-sm"><i
                            class="fa-solid fa-box-open"></i></div> Product Details
                </h3>

                @if($errors->any())
                    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative">
                        <ul class="list-disc ml-4">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Product Name *</label>
                        <input type="text" name="name" required value="{{ old('name') }}"
                            class="w-full rounded-lg border-slate-200 shadow-sm focus:border-slate-500 focus:ring-slate-500 py-2.5 px-4 transition-all duration-200 bg-white"
                            placeholder="e.g. PRISM POD">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Product Image</label>
                        <input type="file" name="image" accept="image/*"
                            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-slate-50 file:text-slate-700 hover:file:bg-slate-100 transition-all border border-slate-200 rounded-lg bg-white" />
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Description *</label>
                        <textarea name="description" rows="4"
                            class="w-full rounded-lg border-slate-200 shadow-sm focus:border-slate-500 focus:ring-slate-500 py-2.5 px-4 bg-white wysiwyg">{{ old('description') }}</textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Deliverables * (HTML allowed)</label>
                        <textarea name="deliverables" rows="4"
                            class="w-full rounded-lg border-slate-200 shadow-sm focus:border-slate-500 focus:ring-slate-500 py-2.5 px-4 bg-white wysiwyg">{{ old('deliverables') }}</textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Project Timeline (HTML allowed
                            optional)</label>
                        <textarea name="project_timeline" rows="4"
                            class="w-full rounded-lg border-slate-200 shadow-sm focus:border-slate-500 focus:ring-slate-500 py-2.5 px-4 bg-white wysiwyg">{{ old('project_timeline') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Prices Section -->
            <div class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-slate-800 flex items-center gap-3">
                        <div class="w-8 h-8 rounded bg-slate-200 text-slate-600 flex items-center justify-center text-sm"><i
                                class="fa-solid fa-tags"></i></div> Pricing Options
                    </h3>
                    <button type="button" id="add-price"
                        class="bg-indigo-50 text-indigo-600 hover:bg-indigo-100 font-bold px-4 py-2 rounded-lg transition-colors border border-indigo-200 text-sm flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i> Add Price Option
                    </button>
                </div>

                <div id="prices-container" class="space-y-4">
                    <!-- Price template goes here -->
                </div>
            </div>

            <div class="bg-slate-50 p-6 border-t border-slate-100 flex justify-end gap-4 rounded-b-2xl">
                <button type="submit"
                    class="bg-slate-900 hover:bg-slate-800 text-white font-bold py-2.5 px-8 rounded-lg shadow transition-all">
                    Save Product
                </button>
            </div>
        </form>
    </div>

    <!-- Template -->
    <template id="price-template">
        <div
            class="price-row grid grid-cols-1 sm:grid-cols-5 gap-4 bg-white p-4 border border-slate-200 rounded-lg relative">
            <div>
                <label class="block text-xs uppercase text-slate-400 mb-1">Type *</label>
                <select name="prices[__INDEX__][type]" required
                    class="w-full bg-slate-50 border border-slate-200 rounded p-2 text-sm price-type-select">
                    <option value="Fixed">Fixed Cost</option>
                    <option value="SaaS">SaaS</option>
                    <option value="HaaS">HaaS</option>
                    <option value="Included">Included</option>
                </select>
            </div>
            <div>
                <label class="block text-xs uppercase text-slate-400 mb-1">Setup / Capital Fee *</label>
                <input type="number" step="0.01" min="0" required name="prices[__INDEX__][setup_fee]" value="0"
                    class="w-full bg-slate-50 border border-slate-200 rounded p-2 text-sm">
            </div>
            <div class="monthly-wrapper hidden">
                <label class="block text-xs uppercase text-slate-400 mb-1">Monthly Fee *</label>
                <input type="number" step="0.01" min="0" required name="prices[__INDEX__][monthly_fee]" value="0"
                    class="w-full bg-slate-50 border border-slate-200 rounded p-2 text-sm">
            </div>
            <div class="term-wrapper hidden">
                <label class="block text-xs uppercase text-slate-400 mb-1">Term (Months)</label>
                <input type="number" min="0" name="prices[__INDEX__][term_months]"
                    class="w-full bg-slate-50 border border-slate-200 rounded p-2 text-sm">
            </div>
            <div class="flex items-end pb-1 justify-end">
                <button type="button"
                    class="remove-price text-slate-400 hover:text-red-500 w-8 h-8 rounded-lg flex items-center justify-center transition-all bg-slate-50 border border-slate-200 hover:bg-red-50 hover:border-red-200">
                    <i class="fa-solid fa-trash text-sm"></i>
                </button>
            </div>
        </div>
    </template>

    @push('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
        <style>
            .ck-editor__editable {
                min-height: 150px;
            }
        </style>
        <script>
            document.addEventListener('turbo:load', function () {
                const initEditor = () => {
                    if (typeof ClassicEditor !== 'undefined') {
                        document.querySelectorAll('.wysiwyg').forEach(el => {
                            // Only init if not already initialized
                            if (!el.classList.contains('ck-initialized')) {
                                ClassicEditor.create(el).then(editor => {
                                    el.classList.add('ck-initialized');
                                }).catch(error => console.error(error));
                            }
                        });
                    } else {
                        setTimeout(initEditor, 100);
                    }
                };
                initEditor();

                let priceIndex = 0;
                const container = document.getElementById('prices-container');
                const template = document.getElementById('price-template');

                document.getElementById('add-price').addEventListener('click', function () {
                    const clone = template.content.cloneNode(true);
                    const row = clone.querySelector('.price-row');
                    row.querySelectorAll('input, select').forEach(el => {
                        el.name = el.name.replace('__INDEX__', priceIndex);
                    });

                    const typeSelect = row.querySelector('.price-type-select');
                    const monthlyWrapper = row.querySelector('.monthly-wrapper');
                    const termWrapper = row.querySelector('.term-wrapper');

                    function toggleFields() {
                        const isSubscription = ['SaaS', 'HaaS'].includes(typeSelect.value);
                        if (isSubscription) {
                            monthlyWrapper.classList.remove('hidden');
                            termWrapper.classList.remove('hidden');
                        } else {
                            monthlyWrapper.classList.add('hidden');
                            termWrapper.classList.add('hidden');
                            monthlyWrapper.querySelector('input').value = '0';
                            termWrapper.querySelector('input').value = '';
                        }
                    }

                    typeSelect.addEventListener('change', toggleFields);
                    toggleFields(); // initial run

                    row.querySelector('.remove-price').addEventListener('click', () => row.remove());
                    container.appendChild(row);
                    priceIndex++;
                });

                // Add initial row
                document.getElementById('add-price').click();
            });
        </script>
    @endpush
@endsection