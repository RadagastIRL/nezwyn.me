<svg class="seal" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Tinkerflare Lounge mark">
  <defs>
    <clipPath id="seal-clip"><circle cx="60" cy="60" r="54"/></clipPath>
  </defs>

  <!-- outer ring -->
  <circle cx="60" cy="60" r="54" fill="none" stroke="currentColor" stroke-width="2.4"/>
  <circle cx="60" cy="60" r="49" fill="none" stroke="currentColor" stroke-width="0.7"/>

  <!-- ornamental stars on the ring -->
  <g fill="currentColor" opacity="0.85">
    <circle cx="60" cy="9.5" r="1.5"/>
    <circle cx="60" cy="110.5" r="1.5"/>
    <circle cx="9.5" cy="60" r="1.5"/>
    <circle cx="110.5" cy="60" r="1.5"/>
  </g>

  <!-- open book -->
  <g clip-path="url(#seal-clip)">
    <path d="M22 78 Q60 66 98 78 L98 86 Q60 74 22 86 Z"
          fill="currentColor" opacity="0.92"/>
    <path d="M22 78 Q60 66 98 78"
          fill="none" stroke="currentColor" stroke-width="1.2" opacity="0.4"/>
    <line x1="60" y1="69" x2="60" y2="84" stroke="var(--seal-bg, #F2E9D0)" stroke-width="1.2"/>
    <!-- page lines -->
    <path d="M30 73 L54 71" stroke="var(--seal-bg, #F2E9D0)" stroke-width="0.8" fill="none" opacity="0.7"/>
    <path d="M66 71 L90 73" stroke="var(--seal-bg, #F2E9D0)" stroke-width="0.8" fill="none" opacity="0.7"/>
    <path d="M30 76 L52 74" stroke="var(--seal-bg, #F2E9D0)" stroke-width="0.8" fill="none" opacity="0.55"/>
    <path d="M68 74 L90 76" stroke="var(--seal-bg, #F2E9D0)" stroke-width="0.8" fill="none" opacity="0.55"/>
  </g>

  <!-- sparks rising from the book -->
  <g fill="currentColor">
    <!-- center 4-point spark -->
    <path d="M60 30
             L62 44 L60 46 L58 44 Z
             M60 30
             L58 44 L60 46 L62 44 Z
             M60 30
             L74 41 L60 42 Z
             M60 30
             L46 41 L60 42 Z" opacity="0"/>
    <g transform="translate(60 38)">
      <path d="M0 -14 L1.4 -2 L0 0 L-1.4 -2 Z"/>
      <path d="M-12 0 L-2 -1.4 L0 0 L-2 1.4 Z"/>
      <path d="M12 0 L2 -1.4 L0 0 L2 1.4 Z"/>
      <path d="M0 14 L1.4 2 L0 0 L-1.4 2 Z" opacity="0.7"/>
    </g>
    <!-- side motes -->
    <circle cx="40" cy="50" r="1.6"/>
    <circle cx="80" cy="50" r="1.6"/>
    <circle cx="34" cy="42" r="1"/>
    <circle cx="86" cy="42" r="1"/>
    <circle cx="46" cy="34" r="0.9"/>
    <circle cx="74" cy="34" r="0.9"/>
  </g>

  <!-- small monogram T centered above book, hairline -->
  <g fill="none" stroke="currentColor" stroke-width="0.9" opacity="0">
    <path d="M55 60 L65 60 M60 60 L60 70"/>
  </g>
</svg>
