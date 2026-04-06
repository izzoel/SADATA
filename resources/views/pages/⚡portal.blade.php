<?php
use App\Models\Menu;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;

new class extends Component {
    #[Computed]
    public function menus()
    {
        return Menu::all();
    }
};
?>

@push('style')
    <style>
        .features-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .features-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        }

        .card-title {
            font-weight: 600;
            font-size: 16px;
            color: #2a2a2a;
        }

        .card-image img {
            max-height: 90px;
            transition: transform 0.3s ease;
        }

        .features-card:hover .card-image img {
            transform: scale(1.1);
        }

        .card-footer {
            margin-top: 16px;
        }

        .arrow-icon {
            width: 36px;
            height: 36px;
            background: #fba70b;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
            font-size: 18px;
        }

        .features-card:hover .arrow-icon {
            transform: translateX(5px);
            background: #ff8c00;
        }

        .color-white {
            color: white;
        }

        /* .flip-box {
                            position: relative;
                            transform-style: preserve-3d;
                            perspective: 1200px;
                            cursor: pointer;
                            height: 340px;
                        } */

        .flip-box {
            position: relative;
            width: 100%;
            height: 100%;
            min-height: 340px;
            /* ganti dari height fixed */
            perspective: 1200px;
            display: block;
        }

        .flip-box .features-itemx:first-child {
            transform: rotateY(0deg);
            z-index: 2;
            opacity: 1;
        }

        .flip-box .features-itemx:last-child {
            transform: rotateY(180deg);
            opacity: 0;
        }

        /* .flip-box:hover .features-itemx:first-child {
                                    transform: rotateY(-180deg);
                                    opacity: 0;
                                }

                                .flip-box:hover .features-itemx:last-child {
                                    transform: rotateY(0deg);
                                    transition-delay: 0.2s;
                                    opacity: 1;
                                } */

        .flip-box:hover .features-itemx {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .flip-box:hover .features-itemx:first-child {
            transform: rotateY(-180deg);
            opacity: 0;
        }

        .flip-box:hover .features-itemx:last-child {
            transform: rotateY(0deg);
            opacity: 1;
        }

        .flip-box .inner {
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            padding: 40px;

            transform: translateY(-50%) translateZ(80px) scale(1);
        }

        .flip-box-header {
            font-size: 30px;
        }

        .flip-box p {
            font-size: 20px;
            line-height: 1.5rem;
        }

        .features-itemx {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;

            box-sizing: border-box;

            display: flex;
            flex-direction: column;
            justify-content: center;

            border-radius: 5px;
            text-align: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);

            backface-visibility: hidden;
            transform-style: preserve-3d;
            transition: transform 0.4s cubic-bezier(.4, .2, .2, 1),
                opacity 0.4s ease;
        }

        .menu-button {
            color: #fba70b;
            border-color: #fba70b;
            background-color: transparent;
        }

        .menu-button:hover {
            color: #fff;
            background-color: #fba70b;
            border-color: #fba70b;
        }

        .menu-button:active,
        .menu-button.active {
            color: #fff;
            background-color: #fba70b !important;
            border-color: #fba70b !important;
        }

        .menu-button:focus {
            color: #fff;
            background-color: #fba70b;
            border-color: #fba70b;
            box-shadow: 0 0 0 0.2rem rgba(251, 167, 11, 0.4);
        }

        .bg-back {
            position: relative;
            background-image: url('/assets/images/statistik-dasar.png');
            background-size: cover;
            background-position: center;
            overflow: hidden;
        }

        .bg-back::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom,
                    rgba(255, 255, 255, 0.906),
                    rgb(255, 255, 255));
            z-index: 1;
        }

        .bg-back .features-icon {
            position: relative;
            z-index: 2;
            color: #000;
        }
    </style>
@endpush

<div>
    <div class="container py-5">
        <div class="row justify-content-center">

            @foreach ($this->menus as $menu)
                @php
                    $delay = 0.2 * $loop->index;
                @endphp
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex" data-scroll-reveal="enter bottom move 30px over 0.6s after {{ $delay }}s">

                    <div class="flip-box">

                        <div class="features-itemx">
                            <div class="card-inner d-flex flex-column h-100">

                                <h5 class="card-title mb-2 pt-5">{{ $menu->menu }}</h5>
                                <div class="card-image text-center d-flex align-items-center justify-content-center flex-fill">
                                    <img src="{{ asset('assets/images/features-icon-1.png') }}" alt="" class="img-fluid">
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between mt-auto">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ $menu->logo ? asset('assets/images/bps.webp') : asset('assets/images/tapin.svg') }}" width="36"
                                            class="rounded-circle bg-light p-1" alt="Logo">
                                        <span class="small text-muted">Sumber Data</span>
                                    </div>

                                    <div class="arrow-icon">
                                        <i class='bx bxs-right-arrow-alt'></i>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Back -->
                        <div class="features-itemx pb-4 bg-back">

                            <div class="features-icon flip-box-back d-flex flex-column h-100">
                                <h2 class="mb-3 pt-5">{{ $menu->menu }}</h2>
                                <p class="flex-1 d-flex align-items-center justify-content-center text-center">
                                    {{ $menu->deskripsi }}
                                </p>
                                <a href="{{ $menu->link }}" type="button" class="btn btn-outline-primary mt-auto menu-button mx-5">
                                    Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
