@extends(Auth::guard('admin')->user()->role == 'super_admin' ? 'layouts.admin' : 'layouts.category')

@section('title', 'Manage Events')

@section('content')
<div class="max-w-4xl mx-auto space-y-10">
    <div class="flex items-center gap-6 px-4">
        <a href="{{ route('admin.events.index') }}" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:text-white transition-all">
            <i class="fas fa-chevron-left"></i>
        </a>
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight">{{ isset($event) ? 'Modify Module' : 'Deploy New Module' }}</h1>
            <p class="text-slate-500 text-sm mt-1">Configure competition parameters and public-facing metadata.</p>
        </div>
    </div>

    <form action="{{ isset($event) ? route('admin.events.update', $event) : route('admin.events.store') }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="space-y-8">
        @csrf
        @if(isset($event)) @method('PUT') @endif

        <div class="glass-card p-10 space-y-10">
            <!-- Primary Intel -->
            <div class="space-y-6">
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-6 bg-blue-600 rounded-full"></div>
                    <h3 class="text-sm font-black uppercase tracking-[3px] text-white">Core Specification</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-[2px] text-slate-500 px-1">Competition Title</label>
                        <input type="text" name="name" value="{{ $event->name ?? old('name') }}" required 
                               class="w-full bg-white/5 border border-white/5 rounded-2xl px-5 py-4 text-white placeholder:text-slate-700 focus:outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/5 transition-all"
                               placeholder="e.g. Master Hackathon 2026">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-[2px] text-slate-500 px-1">Fiscal Entry Fee (INR)</label>
                        <input type="number" name="fees" value="{{ $event->fees ?? old('fees') }}" step="0.01"
                               class="w-full bg-white/5 border border-white/5 rounded-2xl px-5 py-4 text-white placeholder:text-slate-700 focus:outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/5 transition-all"
                               placeholder="0.00">
                    </div>
                </div>
            </div>

            <!-- Categorization -->
            <div class="space-y-6">
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-6 bg-indigo-600 rounded-full"></div>
                    <h3 class="text-sm font-black uppercase tracking-[3px] text-white">Taxonomy & Schedule</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-[2px] text-slate-500 px-1">Sector Hub</label>
                        @php 
                            $currentCategory = $category ?? ($event->category ?? old('category'));
                            $isAdmin = auth('admin')->user()->role === 'super_admin';
                        @endphp
                        <div class="relative group">
                            <select name="category" required {{ !$isAdmin ? 'disabled' : '' }}
                                    class="w-full bg-[#070a13] border border-white/5 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-indigo-500/50 focus:ring-4 focus:ring-indigo-500/5 transition-all appearance-none cursor-pointer {{ !$isAdmin ? 'opacity-50 cursor-not-allowed' : '' }}">
                                <option value="Sports" {{ $currentCategory == 'Sports' ? 'selected' : '' }}>Arena (Sports)</option>
                                <option value="Arts" {{ $currentCategory == 'Arts' ? 'selected' : '' }}>Utsav (Arts)</option>
                                <option value="Algorithm" {{ $currentCategory == 'Algorithm' ? 'selected' : '' }}>Algorythm (Tech)</option>
                                <option value="softskill" {{ $currentCategory == 'softskill' ? 'selected' : '' }}>Elevate (Soft Skills)</option>
                                <option value="Cultural" {{ $currentCategory == 'Cultural' ? 'selected' : '' }}>Cultural</option>
                            </select>
                            @if(!$isAdmin)
                                <input type="hidden" name="category" value="{{ $currentCategory }}">
                            @endif
                        </div>
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-[2px] text-slate-500 px-1">Sub-Classification</label>
                        <select name="sub_category" 
                                class="w-full bg-[#070a13] border border-white/5 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-indigo-500/50 focus:ring-4 focus:ring-indigo-500/5 transition-all appearance-none cursor-pointer">
                            <option value="Indoor" {{ (isset($event) && $event->sub_category == 'Indoor') ? 'selected' : '' }}>Indoor Operation</option>
                            <option value="Outdoor" {{ (isset($event) && $event->sub_category == 'Outdoor') ? 'selected' : '' }}>Outdoor Operation</option>
                            <option value="Workshop" {{ (isset($event) && $event->sub_category == 'Workshop') ? 'selected' : '' }}>Workshop/Seminar</option>
                        </select>
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-[2px] text-slate-500 px-1">Operational Window</label>
                        <input type="text" name="time" value="{{ $event->time ?? old('time') }}" 
                               class="w-full bg-white/5 border border-white/5 rounded-2xl px-5 py-4 text-white placeholder:text-slate-700 focus:outline-none focus:border-indigo-500/50 focus:ring-4 focus:ring-indigo-500/5 transition-all"
                               placeholder="e.g. 09:00 - 17:00 HRS">
                    </div>
                </div>
            </div>

            <div class="space-y-3">
                <label class="text-[10px] font-black uppercase tracking-[2px] text-slate-500 px-1">Functional Brief</label>
                <textarea name="description" rows="4" 
                          class="w-full bg-white/5 border border-white/5 rounded-2xl px-5 py-4 text-white placeholder:text-slate-700 focus:outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/5 transition-all resize-none"
                          placeholder="Detail the operational rules and module objectives...">{{ $event->description ?? old('description') }}</textarea>
            </div>

            <!-- Visual Asset -->
            <div class="pt-6 border-t border-white/5">
                <div class="flex flex-col md:flex-row items-center gap-10">
                    <div class="w-48 h-48 rounded-3xl bg-white/[0.02] border-2 border-dashed border-white/10 flex items-center justify-center overflow-hidden relative group" id="previewContainer">
                        @if(isset($event) && $event->image_path)
                            <img src="{{ asset('storage/' . $event->image_path) }}" id="preview" class="w-full h-full object-cover">
                        @else
                            <div class="text-center space-y-2 opacity-20 group-hover:opacity-40 transition-opacity">
                                <i class="fas fa-cloud-arrow-up text-4xl"></i>
                                <p class="text-[10px] font-black uppercase tracking-widest">Asset Required</p>
                            </div>
                        @endif
                        <input type="file" name="image" id="imageInput" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*">
                    </div>
                    <div class="flex-1 space-y-4">
                        <h4 class="text-white font-bold">Visual Representation</h4>
                        <p class="text-slate-500 text-xs leading-relaxed max-w-sm">Upload a high-resolution visual asset for this module. Optimal dimensions are 1024x1024 with a maximum file size of 5MB.</p>
                        <button type="button" onclick="document.getElementById('imageInput').click()" 
                                class="px-6 py-3 bg-white/5 hover:bg-white/10 text-white rounded-xl text-xs font-black uppercase tracking-widest border border-white/10 transition-all">
                            Browse Local Files
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 pt-6">
            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-500 text-white py-5 rounded-2xl font-black uppercase tracking-[2px] text-sm shadow-xl shadow-blue-500/20 transition-all active:scale-[0.98]">
                {{ isset($event) ? 'Confirm Modification' : 'Deploy Module' }}
            </button>
            <a href="{{ route('admin.events.index') }}" class="px-12 bg-white/5 hover:bg-white/10 text-white py-5 rounded-2xl font-black uppercase tracking-[2px] text-sm border border-white/5 transition-all text-center">
                Abort
            </a>
        </div>
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
