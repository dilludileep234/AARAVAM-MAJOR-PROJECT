@extends(Auth::guard('admin')->user()->role == 'super_admin' ? 'layouts.admin' : 'layouts.category')

@section('title', 'Manage Photo Gallery')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-white tracking-tight flex items-center gap-3">
        <i class="fas fa-images text-blue-500"></i>
        Fest Photo Gallery
    </h1>
</div>

@if(session('success'))
    <div class="bg-green-500/10 border border-green-500/20 text-green-400 p-4 rounded-xl mb-6 flex items-center gap-3 animate__animated animate__fadeIn">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

<!-- Upload Section -->
<div class="grid md:grid-cols-3 gap-8 mb-12">
    <div class="md:col-span-1">
        <div class="glass-card p-6 sticky top-24">
            <h3 class="text-xl font-bold text-white mb-6">Add New Image</h3>
            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-400 mb-2">Category</label>
                    <select name="category" required class="w-full bg-slate-900/50 border border-white/10 rounded-xl py-3 px-4 text-white focus:outline-none focus:border-blue-500 transition appearance-none cursor-pointer">
                        <option value="arts">Arts (Utsav)</option>
                        <option value="sports">Sports (Arena)</option>
                        <option value="tech">Tech (Algorythm)</option>
                        <option value="cultural">Cultural</option>
                        <option value="elevate">Elevate</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-400 mb-2">Image File</label>
                    <div class="relative group">
                        <input type="file" name="image" id="gallery-upload" required accept="image/*" class="hidden">
                        <label for="gallery-upload" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-white/10 rounded-2xl cursor-pointer hover:border-blue-500/50 hover:bg-blue-500/5 transition duration-300">
                            <i class="fas fa-cloud-upload-alt text-3xl text-slate-500 mb-3 group-hover:text-blue-500 transition"></i>
                            <span class="text-sm text-slate-400 group-hover:text-slate-300 transition">Click or Drag Image</span>
                            <span id="file-name" class="text-xs text-blue-400 mt-2 font-medium"></span>
                        </label>
                    </div>
                    <p class="text-[10px] text-slate-500 mt-2 italic">* Max size: 5MB (JPG, PNG, JPG)</p>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl transition shadow-lg shadow-blue-600/20 flex items-center justify-center gap-2">
                    <i class="fas fa-upload"></i> Upload Image
                </button>
            </form>
        </div>
    </div>

    <!-- Gallery View -->
    <div class="md:col-span-2 space-y-10">
        @php
            $categories = [
                'arts' => ['title' => 'Arts (Utsav)', 'color' => 'blue'],
                'sports' => ['title' => 'Sports (Arena)', 'color' => 'orange'],
                'tech' => ['title' => 'Tech (Algorythm)', 'color' => 'cyan'],
                'cultural' => ['title' => 'Cultural', 'color' => 'pink'],
                'elevate' => ['title' => 'Elevate', 'color' => 'purple']
            ];
        @endphp

        @foreach($categories as $key => $catData)
            <div class="reveal animate__animated animate__fadeInUp">
                <div class="flex items-center justify-between mb-4 px-2">
                    <h4 class="text-lg font-bold text-white flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-{{ $catData['color'] }}-500"></span>
                        {{ $catData['title'] }}
                        <span class="text-xs text-slate-500 font-normal ml-2">({{ isset($galleries[$key]) ? count($galleries[$key]) : 0 }} images)</span>
                    </h4>
                </div>

                @if(isset($galleries[$key]))
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach($galleries[$key] as $image)
                            <div class="group relative aspect-square rounded-2xl overflow-hidden border border-white/5 glass-card">
                                <img src="{{ $image->url }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                                <div class="absolute inset-0 bg-slate-950/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-4 z-10">
                                    <button type="button" 
                                            onclick="openEditModal({{ $image->id }}, '{{ $image->category }}', '{{ $image->url }}')" 
                                            class="w-11 h-11 rounded-full bg-blue-500 hover:bg-blue-600 text-white flex items-center justify-center transition-all duration-200 shadow-xl hover:scale-110 active:scale-95"
                                            title="Edit Image">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <form action="{{ route('admin.gallery.destroy', $image) }}" method="POST" onsubmit="return confirm('Remove this image from gallery?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-11 h-11 rounded-full bg-red-500 hover:bg-red-600 text-white flex items-center justify-center transition-all duration-200 shadow-xl hover:scale-110 active:scale-95"
                                                title="Delete Image">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-8 border border-dashed border-white/5 rounded-2xl text-center text-slate-500 italic text-sm">
                        No images uploaded for this category.
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>

<!-- Edit Modal -->
<div id="edit-modal" class="fixed inset-0 z-[100] hidden">
    <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" onclick="closeEditModal()"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md p-4">
        <div class="glass-card p-8 animate__animated animate__zoomIn border border-white/10 shadow-2xl">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-white">Edit Gallery Image</h3>
                <button onclick="closeEditModal()" class="text-slate-500 hover:text-white transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="edit-form" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PATCH')
                
                <div class="aspect-video rounded-xl overflow-hidden border border-white/10 bg-slate-900">
                    <img id="edit-preview" src="" class="w-full h-full object-cover">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-400 mb-2">Category</label>
                    <select name="category" id="edit-category" @if(Auth::guard('admin')->user()->role !== 'super_admin') disabled @endif required class="w-full bg-slate-900/50 border border-white/10 rounded-xl py-3 px-4 text-white focus:outline-none focus:border-blue-500 transition appearance-none cursor-pointer disabled:opacity-50">
                        <option value="arts">Arts (Utsav)</option>
                        <option value="sports">Sports (Arena)</option>
                        <option value="tech">Tech (Algorythm)</option>
                        <option value="cultural">Cultural</option>
                        <option value="elevate">Elevate</option>
                    </select>
                    @if(Auth::guard('admin')->user()->role !== 'super_admin')
                        <input type="hidden" name="category" id="edit-category-hidden">
                    @endif
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-400 mb-2">Replace Image (Optional)</label>
                    <input type="file" name="image" id="edit-upload-input" accept="image/*" class="w-full text-slate-400 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-500/10 file:text-blue-400 hover:file:bg-blue-500/20 transition cursor-pointer">
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closeEditModal()" class="flex-1 px-6 py-3 rounded-xl border border-white/10 text-slate-300 hover:bg-white/5 transition font-bold">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition shadow-lg shadow-blue-600/20">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // New Image Upload Preview
    document.getElementById('gallery-upload').onchange = function() {
        if(this.files[0]) {
            document.getElementById('file-name').textContent = "Selected: " + this.files[0].name;
        }
    };

    // Edit Modal Logic
    const editModal = document.getElementById('edit-modal');
    const editForm = document.getElementById('edit-form');
    const editPreview = document.getElementById('edit-preview');
    const editCategory = document.getElementById('edit-category');
    const editCategoryHidden = document.getElementById('edit-category-hidden');
    const editUploadInput = document.getElementById('edit-upload-input');

    function openEditModal(id, category, imageUrl) {
        editForm.action = `/admin/gallery/${id}`;
        editPreview.src = imageUrl;
        editCategory.value = category;
        if(editCategoryHidden) editCategoryHidden.value = category;
        
        editModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeEditModal() {
        editModal.classList.add('hidden');
        document.body.style.overflow = '';
        editUploadInput.value = '';
    }

    // Modal Image Preview
    editUploadInput.onchange = function() {
        if(this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                editPreview.src = e.target.result;
            }
            reader.readAsDataURL(this.files[0]);
        }
    };
</script>
@endsection
