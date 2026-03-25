<style>
    /* Global Theme Variables */
    :root {
        --bg-main: #050a18;
        --text-main: #ffffff;
        --text-muted: #9ca3af;
        --glass-bg: rgba(255, 255, 255, 0.03);
        --glass-border: rgba(255, 255, 255, 0.1);
        --header-bg: rgba(5, 10, 24, 0.8);
        --accent-blue: #3b82f6;
        --card-hover: rgba(255, 255, 255, 0.07);
    }

    .light-theme {
        --bg-main: #f1f5f9;
        --text-main: #0f172a;
        --text-muted: #334155;
        --glass-bg: rgba(255, 255, 255, 0.7);
        --glass-border: rgba(15, 23, 42, 0.1);
        --header-bg: rgba(241, 245, 249, 0.85);
        --accent-blue: #2563eb;
        --card-hover: rgba(59, 130, 246, 0.08);
        
        /* Compatibility Aliases */
        --bg-color: var(--bg-main);
        --bg-dark: var(--bg-main);
        --card-bg: #ffffff;
        --text-dim: var(--text-muted);
        --border: var(--glass-border);
        --social-bg: rgba(15, 23, 42, 0.04);
        --social-text: var(--text-muted);
    }

    /* Global Overrides for Light Theme */
    .light-theme body { 
        background-color: var(--bg-main) !important;
        color: var(--text-main) !important;
    }

    .light-theme .text-white { color: var(--text-main) !important; }
    .light-theme .text-slate-200, 
    .light-theme .text-slate-300,
    .light-theme .text-slate-400 { color: #1e293b !important; }
    
    .light-theme .dynamic-text-muted,
    .light-theme .text-slate-500 { color: var(--text-muted) !important; }

    .light-theme .glass,
    .light-theme .glass-card,
    .light-theme .glass-panel {
        background: var(--glass-bg) !important;
        border-color: var(--glass-border) !important;
    }

    .light-theme footer,
    .light-theme .bg-slate-950\/50,
    .light-theme .bg-blue-900\/5 {
        background-color: rgba(241, 245, 249, 0.9) !important;
        border-top-color: var(--glass-border) !important;
    }

    .light-theme .dropdown-item { color: var(--text-main) !important; }
    .light-theme .profile-dropdown { background: rgba(255, 255, 255, 0.95) !important; }
</style>

<script>
    if (!window.themeSystemInitialized) {
        window.themeSystemInitialized = true;

        (function() {
            const theme = localStorage.getItem('theme') || 'dark';
            if (theme === 'light') {
                document.documentElement.classList.add('light-theme');
            }
        })();

        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('theme-toggle');
            const themeIcon = document.getElementById('theme-icon');
            const body = document.body;
            const html = document.documentElement;

            // Ensure body matches html state on load
            if (html.classList.contains('light-theme')) {
                body.classList.add('light-theme');
                if (themeIcon) themeIcon.classList.replace('fa-moon', 'fa-sun');
            }

            if (!themeToggle || !themeIcon) return;

            themeToggle.addEventListener('click', () => {
                const isLight = html.classList.toggle('light-theme');
                body.classList.toggle('light-theme', isLight);
                localStorage.setItem('theme', isLight ? 'light' : 'dark');
                
                // Dispatch global event for pages with custom logic (like particles)
                window.dispatchEvent(new CustomEvent('theme-changed', { 
                    detail: { theme: isLight ? 'light' : 'dark' } 
                }));
                
                themeIcon.style.transform = 'rotate(360deg) scale(0)';
                setTimeout(() => {
                    if (isLight) {
                        themeIcon.classList.replace('fa-moon', 'fa-sun');
                    } else {
                        themeIcon.classList.replace('fa-sun', 'fa-moon');
                    }
                    themeIcon.style.transform = 'rotate(0deg) scale(1)';
                }, 200);
            });
        });
    }
</script>
