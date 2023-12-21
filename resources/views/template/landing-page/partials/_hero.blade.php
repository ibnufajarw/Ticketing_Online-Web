{{-- Hero --}}
<div id="hero" class="d-flex justify-content-center">
    @if(request()->is('/'))
        <div class="text-hero text-white">
            <h3>Khusus Kota Bandung</h3>
            <h1 class="text-title fs-60">EASY BOOK & EASY IN</h1>
            <h5 class="fs-14">Kegiatan acara yang kamu butuhkan ada disini.</h5>
        </div>
    @endif
</div>

{{-- search bar --}}
@if(request()->is('/'))
    <div class="container-fluid">
        <div class="row justify-content-center search-bar">
            <div class="col-lg-6 bg-white shadow-sm wrap-search-form rounded">
                <form action="">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend bg-white border d-flex align-items-center">
                                <div class="input-group-text border-0 bg-white"><i class="fa-solid fa-magnifying-glass"></i></div>
                            </div>
                            <input type="text" class="form-control fs-14 border-start-0" id="inlineFormInputGroup" placeholder="Cari Sesuatu">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif