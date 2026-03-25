@extends(Auth::guard('admin')->user()->role == 'super_admin' ? 'layouts.admin' : 'layouts.category')

@section('title', 'Manage Events')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.events.index') }}" class="text-slate-500 hover:text-white"><i class="fas fa-arrow-left"></i></a>
        <h1 class="text-3xl font-bold text-white">{{ isset($event) ? 'Edit Event' : 'Create New Event' }}</h1>
    </div>

    <form action="{{ isset($event) ? route('admin.events.update', $event) : route('admin.events.store') }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="space-y-6">
        @csrf
        @if(isset($event)) @method('PUT') @endif

        <div class="glass-card p-8 space-y-6">
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-400">Competition Name</label>
                    <input type="text" name="name" value="{{ $event->name ?? old('name') }}" required 
                           class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 transition"
                           placeholder="e.g. Premier Football Cup">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-400">Registration Fees</label>
                    <input type="number" name="fees" value="{{ $event->fees ?? old('fees') }}" step="0.01"
                           class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 transition"
                           placeholder="0.00">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    @php 
                        $isAdmin = auth('admin')->user()->role === 'super_admin';
                        $currentCategory = $event->category ?? old('category');
                    @endphp
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-400">Main Category</label>
                    <select name="category" required {{ !$isAdmin ? 'disabled' : '' }}
                            class="w-full bg-[#1e293b] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 transition {{ !$isAdmin ? 'opacity-50' : '' }}">
                        <option value="Sports" {{ $currentCategory == 'Sports' ? 'selected' : '' }}>Sports</option>
                        <option value="Arts" {{ $currentCategory == 'Arts' ? 'selected' : '' }}>Arts</option>
                        <option value="Algorithm" {{ $currentCategory == 'Algorithm' ? 'selected' : '' }}>Algorithm</option>
                        <option value="softskill" {{ $currentCategory == 'softskill' ? 'selected' : '' }}>Soft Skill</option>
                        <option value="Cultural" {{ $currentCategory == 'Cultural' ? 'selected' : '' }}>Cultural</option>
                    </select>
                    @if(!$isAdmin)
                        <input type="hidden" name="category" value="{{ $currentCategory }}">
                    @endif
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-400">Sub Category</label>
                    <select name="sub_category" 
                            class="w-full bg-[#0f172a] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 transition">
                        <option value="Indoor" {{ (isset($event) && $event->sub_category == 'Indoor') ? 'selected' : '' }}>Indoor</option>
                        <option value="Outdoor" {{ (isset($event) && $event->sub_category == 'Outdoor') ? 'selected' : '' }}>Outdoor</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-400">Time / Schedule</label>
                    <input type="text" name="time" value="{{ $event->time ?? old('time') }}" 
                           class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 transition"
                           placeholder="e.g. 10:00 AM - 12:00 PM">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-wider text-slate-400">Description</label>
                <textarea name="description" rows="4" 
                          class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 transition"
                          placeholder="Briefly describe the competition rules and format...">{{ $event->description ?? old('description') }}</textarea>
            </div>

            <div class="space-y-4">
                <label class="text-xs font-bold uppercase tracking-wider text-slate-400 block">Event Poster / Image</label>
                <div class="flex items-center gap-6">
                    <div class="w-32 h-32 rounded-2xl bg-white/5 border-2 border-dashed border-white/10 flex items-center justify-center overflow-hidden" id="previewContainer">
                        @if(isset($event) && $event->image_path)
                            <img src="{{ asset('storage/' . $event->image_path) }}" id="preview" class="w-full h-full object-cover">
                        @else
                            <i class="fas fa-image text-3xl text-slate-700" id="placeholderIcon"></i>
                        @endif
                    </div>
                    <div class="flex-1">
                        <input type="file" name="image" id="imageInput" class="hidden" accept="image/*">
                        <button type="button" onclick="document.getElementById('imageInput').click()" 
                                class="bg-white/5 hover:bg-white/10 text-white px-6 py-3 rounded-xl font-bold transition border border-white/10 inline-flex items-center gap-2">
                            <i class="fas fa-upload"></i> {{ isset($event) ? 'Change Image' : 'Select Image' }}
                        </button>
                        <p class="text-[10px] text-slate-500 mt-2 italic">Recommended: Square aspect ratio, under 2MB (JPG/PNG)</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-xl font-bold text-lg shadow-lg shadow-blue-600/20 transition active:scale-[0.98]">
                {{ isset($event) ? 'Update Competition' : 'Publish Competition' }}
            </button>
            <a href="{{ route('admin.events.index') }}" class="px-8 bg-white/5 hover:bg-white/10 text-white py-4 rounded-xl font-bold border border-white/10 transition">
                Cancel
            </a>
        </div>
    </form>
</div>

<script>
    document.getElementById('imageInput').onchange = function(evt) {
        const [file] = this.files;
        if (file) {
            let preview = document.getElementById('preview');
            if(!preview) {
                preview = document.createElement('img');
                preview.id = 'preview';
                preview.className = 'w-full h-full object-cover';
                document.getElementById('previewContainer').innerHTML = '';
                document.getElementById('previewContainer').appendChild(preview);
            }
            preview.src = URL.createObjectURL(file);
        }
    }
</script>
@endsection
