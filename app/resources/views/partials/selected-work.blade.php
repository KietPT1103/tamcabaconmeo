@php
$selectedWork = [
    ['theme'=>'coffee', 'name'=>'T&N — Ông Quan', 'url'=>'https://tnservice.vn/', 'domain'=>'tnservice.vn', 'category'=>'F&B & LIFESTYLE', 'mood'=>'TRẢI NGHIỆM & CẢM XÚC', 'note'=>'Cà phê · Tiệm lẩu · Farm', 'description'=>'Một điểm chạm số cho thế giới cà phê, tiệm lẩu và những trải nghiệm tại farm Ông Quan.'],
    ['theme'=>'auto', 'name'=>'Tây Đô Auto Car', 'url'=>'https://taydoautocar.vn/', 'domain'=>'taydoautocar.vn', 'category'=>'AUTOMOTIVE', 'mood'=>'CHUYỂN ĐỘNG & PHONG CÁCH', 'note'=>'Một hành trình. Một dấu ấn.', 'description'=>'Không gian trực tuyến mang tên Tây Đô Auto Car, kết nối thương hiệu với khách hàng.'],
    ['theme'=>'law', 'name'=>'Luật Trần A', 'url'=>'https://luattrana.vn/', 'domain'=>'luattrana.vn', 'category'=>'LEGAL & CORPORATE', 'mood'=>'CHỈN CHU & TIN CẬY', 'note'=>'Sự tin cậy bắt đầu từ điểm chạm đầu tiên.', 'description'=>'Một hiện diện trực tuyến dành cho thương hiệu luật, với tinh thần chuyên nghiệp và chỉn chu.'],
];
@endphp
<section class="container work-gallery" id="du-an" aria-labelledby="work-title">
    <div class="work-heading">
        <div><span class="work-kicker">TAM CA / SELECTED WORK</span><h2 id="work-title">Dấu ấn trên <em>Internet.</em></h2></div>
        <div class="work-intro"><p>Mỗi thương hiệu, một cá tính.<br>Những website chúng tôi đã làm và đưa vào hoạt động.</p><span class="work-count">03 WEBSITE ĐÃ TRIỂN KHAI</span></div>
    </div>
    <div class="work-grid">
        @foreach($selectedWork as $work)
        <article class="work-piece work-{{ $work['theme'] }}">
            <a class="work-art" href="{{ $work['url'] }}" target="_blank" rel="noopener noreferrer" aria-label="Khám phá website {{ $work['name'] }} (mở tab mới)">
                <span class="work-art-top"><span>0{{ $loop->iteration }} / {{ $work['mood'] }}</span><span class="work-live"><i></i> Đã triển khai</span></span>
                <div class="work-composition {{ $work['theme'] }}-composition" aria-hidden="true">
                    @switch($work['theme'])
                    @case('coffee')
                    <span class="work-orbit"></span><span class="coffee-sun"></span><span class="coffee-word">Ông<br><em>Quan.</em></span>
                    <svg class="coffee-drawing" viewBox="0 0 300 300" fill="none"><path d="M64 148h147l-13 83c-5 33-108 33-113 0Z" fill="#f6e6c7"/><path d="M211 158h18c49 0 45 64-25 62" stroke="#f6e6c7" stroke-width="14"/><ellipse cx="137" cy="148" rx="74" ry="17" fill="#ba8255"/><ellipse cx="137" cy="148" rx="61" ry="11" fill="#553a28"/><path d="M115 113c-26-27 26-34 0-62m45 62c-26-27 26-34 0-62" stroke="#f6e6c7" stroke-width="3" stroke-linecap="round"/><path d="M62 260h160" stroke="#f6e6c7" stroke-width="3"/><path d="M244 125c-2-52 7-80 23-100m-23 75c-22-9-31-25-28-46 24 3 35 18 28 46m4-22c21 0 36-11 40-31-22-3-36 7-40 31" stroke="#c3c99a" stroke-width="3"/></svg>
                    @break
                    @case('auto')
                    <span class="auto-grid"></span><span class="auto-halo"></span><span class="auto-word">TÂY ĐÔ<small>AUTO CAR</small></span>
                    <svg class="auto-drawing" viewBox="0 0 480 200" fill="none"><path d="m40 127 24-31 82-16 49-39h111l58 48 63 17 18 34H39Z" fill="#142a35" stroke="#acdae0" stroke-width="2"/><path d="m157 82 46-32h92l42 37Z" fill="#476d79" stroke="#acdae0" stroke-width="2"/><path d="M252 49v35m-175 27 39-8m290 16-35-11M133 141h194" stroke="#b9eef1" stroke-width="3"/><circle cx="108" cy="140" r="27" fill="#0b1620" stroke="#a7d2dc" stroke-width="3"/><circle cx="108" cy="140" r="12" stroke="#688a99" stroke-width="4"/><circle cx="358" cy="140" r="27" fill="#0b1620" stroke="#a7d2dc" stroke-width="3"/><circle cx="358" cy="140" r="12" stroke="#688a99" stroke-width="4"/><path d="M27 183h425" stroke="#87b7c5" stroke-opacity=".35"/></svg>
                    @break
                    @case('law')
                    <span class="law-frame"></span><span class="law-word">Luật<br><em>Trần A</em></span>
                    <svg class="law-drawing" viewBox="0 0 240 230" fill="none"><path d="M120 24v155m-64 17h128m-152 17h176M46 69h148M120 35 46 69m74-34 74 34" stroke="#b69a62" stroke-width="3"/><circle cx="120" cy="25" r="7" fill="#b69a62"/><path d="m46 72-29 63h58Zm148 0-29 63h58Z" stroke="#b69a62" stroke-width="2"/><path d="M17 135c3 27 55 27 58 0m90 0c3 27 55 27 58 0" fill="#b69a62" fill-opacity=".22" stroke="#b69a62" stroke-width="2"/></svg>
                    @break
                    @endswitch
                    <span class="work-art-note">{{ $work['note'] }}</span>
                </div>
                <span class="work-art-bottom"><span>{{ $work['domain'] }}</span><span class="work-open" aria-hidden="true">↗</span></span>
            </a>
            <div class="work-caption"><span class="work-category">{{ $work['category'] }}</span><h3>{{ $work['name'] }}</h3><p>{{ $work['description'] }}</p><a class="work-link" href="{{ $work['url'] }}" target="_blank" rel="noopener noreferrer">Khám phá website <span aria-hidden="true">↗</span><span class="sr-only"> (mở tab mới)</span></a></div>
        </article>
        @endforeach
    </div>
    <div class="work-footer"><span>Từ ý tưởng đến một địa chỉ thật trên Internet.</span><a href="#lien-he">Dự án tiếp theo có thể là của bạn {!! $icon('arrow') !!}</a></div>
</section>