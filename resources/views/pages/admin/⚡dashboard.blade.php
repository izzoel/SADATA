<?php

use App\Models\Menu;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Storage;

new class extends Component {
    use WithFileUploads;

    public $editFieldRowId, $selectedId, $selectedLogo;
    public $menu, $deskripsi, $link, $logo, $logoEdit;

    public bool $tampil_tambah = false;

    protected $rules = [
        'menu' => 'required',
        'link' => 'required',
        'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:512',
    ];

    protected $messages = [
        'menu.required' => 'Harus diisi.',
        'link.required' => 'Harus diisi.',
        'logo.image' => 'File harus berupa gambar.',
        'logo.mimes' => 'Format gambar harus jpg, jpeg, png, atau webp.',
        'logo.max' => 'Ukuran gambar maksimal 2MB.',
    ];

    public function render()
    {
        return view('pages::admin.⚡dashboard')->layout('layouts.admin');
    }

    #[Computed]
    public function menus()
    {
        return Menu::orderBy('menu', 'asc')->get();
    }

    public function tambah()
    {
        $this->tampil_tambah = !$this->tampil_tambah;
    }

    public function editRow($id, $field, $value)
    {
        $this->editFieldRowId = $id . '-' . $field;

        if ($field === 'menu') {
            $this->menu = $value;
        }
    }

    public function ubah($id, $field, $value)
    {
        $data = Menu::find($id);

        if (!$data) {
            return;
        }

        $data->update([
            $field => $value,
        ]);

        $this->editFieldRowId = null;

        $this->dispatch('toast_success', $field . ' berhasil diubah.');
        $this->reset(['tampil_tambah']);
    }

    public function simpan()
    {
        $this->validate();

        $logoPath = null;
        if ($this->logo) {
            $logoPath = $this->logo->store('logo', 'public'); // simpan di storage/app/public/logo
        }

        Menu::create([
            'menu' => $this->menu,
            'deskripsi' => $this->deskripsi,
            'link' => $this->link,
            'logo' => $logoPath,
        ]);

        $this->dispatch('toast_success', 'Menu ' . $this->menu . ' berhasil ditambahkan.');
        $this->reset(['tampil_tambah', 'menu']);
    }

    #[On('hapus')]
    public function hapus($id)
    {
        $menu = Menu::findOrFail($id);
        if ($menu->logo && Storage::disk('public')->exists($menu->logo)) {
            Storage::disk('public')->delete($menu->logo);
        }
        $menu->delete();
        $this->dispatch('toast_success', $menu->menu . ' berhasil dihapus.');
    }

    public function selectLogo($id, $namaLogo)
    {
        $this->selectedId = $id;
        $this->selectedLogo = $namaLogo;
        $this->logoEdit = null;
        $this->dispatch('open-modal');
    }

    public function updatedLogoEdit()
    {
        $this->validate([
            'logoEdit' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $menu = Menu::findOrFail($this->selectedId);

        if ($menu->logo && Storage::disk('public')->exists($menu->logo)) {
            Storage::disk('public')->delete($menu->logo);
        }

        $path = $this->logoEdit->store('logo', 'public');

        $menu->update([
            'logo' => $path,
        ]);

        $this->selectedLogo = $path;

        $this->reset('logoEdit');

        $this->dispatch('toast_success', 'Logo berhasil diperbarui.');
        // $this->dispatch('close-modal');
    }
};
?>

@push('css')
    <style>
        .edit-icon .icon-hover {
            opacity: 0;
            transition: opacity 0.2s ease-in-out;
            position: absolute;
            right: -20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: #6c757d;
        }

        .edit-icon:hover .icon-hover {
            opacity: 1;
        }
    </style>
@endpush

<div>
    <h4 class="fw-bold py-3 mb-2">
        <span class="text-muted fw-light">Setting / Menu</span>
        <button wire:click="tambah" type="button" class="btn btn-xs btn-primary rounded-1"><strong>&#10010;</strong></button>
    </h4>
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="p-4">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-center">
                                <th class="col-1">#</th>
                                <th class="col-2 text-start">Menu</th>
                                <th class="col text-start">Deskripsi</th>
                                <th class="col-1 text-start">Link</th>
                                <th class="col-2 text-center">Logo</th>
                                <th class="col-1">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @if ($tampil_tambah)
                                <tr class="text-center" style="background-color: #fff0df;">
                                    <td></td>
                                    <td class="text-start">
                                        <input wire:model="menu" type="text"
                                            class="form-control form-control-md {{ $errors->has('menu') ? 'is-invalid' : 'border border-secondary' }}" placeholder="menu..">

                                        <div class="invalid-feedback">
                                            @error('menu')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </td>
                                    <td class="text-start">
                                        <input wire:model="deskripsi" type="text"
                                            class="form-control form-control-md {{ $errors->has('deskripsi') ? 'is-invalid' : 'border border-secondary' }}"
                                            placeholder="deskripsi..">

                                        <div class="invalid-feedback">
                                            @error('deskripsi')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </td>
                                    <td class="text-start">
                                        <input wire:model="link" type="text"
                                            class="form-control form-control-md {{ $errors->has('link') ? 'is-invalid' : 'border border-secondary' }}" placeholder="link..">

                                        <div class="invalid-feedback">
                                            @error('link')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </td>
                                    <td class="text-start">
                                        <input wire:model="logo" class="form-control form-control-md {{ $errors->has('logo') ? 'is-invalid' : 'border border-secondary' }}"
                                            type="file">

                                        <div class="invalid-feedback">
                                            @error('logo')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </td>
                                    <td>
                                        <button wire:click="simpan" type="button" class="btn btn-sm btn-primary rounded-1">
                                            <strong>Simpan</strong>
                                        </button>
                                    </td>
                                </tr>
                            @endif

                            @foreach ($this->menus as $menu)
                                <tr class="text-center">
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="text-start">
                                        @if ($editFieldRowId == $menu->id . '-menu')
                                            <div class="d-flex justify-content-center">
                                                <input wire:blur="ubah('{{ $menu->id }}', 'menu', $event.target.value)"
                                                    wire:keydown.enter="ubah('{{ $menu->id }}', 'menu', $event.target.value)" class="form-control form-control-sm"
                                                    value="{{ $menu->menu }}" @click.outside="$wire.set('editFieldRowId', null)" />
                                            </div>
                                        @else
                                            <div wire:click="editRow('{{ $menu->id }}', 'menu', '{{ $menu->menu }}')" class="edit-icon"
                                                style="cursor: pointer; position: relative;">
                                                {{ $menu->menu ?? '---' }}
                                                <i class="bx bx-edit-alt text-warning icon-hover"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-start">
                                        @if ($editFieldRowId == $menu->id . '-deskripsi')
                                            <div class="d-flex justify-content-center">
                                                <input wire:blur="ubah('{{ $menu->id }}', 'deskripsi', $event.target.value)"
                                                    wire:keydown.enter="ubah('{{ $menu->id }}', 'deskripsi', $event.target.value)" class="form-control form-control-sm"
                                                    value="{{ $menu->deskripsi }}" @click.outside="$wire.set('editFieldRowId', null)" />
                                            </div>
                                        @else
                                            <div wire:click="editRow('{{ $menu->id }}', 'deskripsi', '{{ $menu->deskripsi }}')" class="edit-icon"
                                                style="cursor: pointer; position: relative;">
                                                {{ $menu->deskripsi ?? '---' }}
                                                <i class="bx bx-edit-alt text-warning icon-hover"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-start">
                                        @if ($editFieldRowId == $menu->id . '-link')
                                            <div class="d-flex justify-content-center">
                                                <input wire:blur="ubah('{{ $menu->id }}', 'link', $event.target.value)"
                                                    wire:keydown.enter="ubah('{{ $menu->id }}', 'link', $event.target.value)" class="form-control form-control-sm"
                                                    value="{{ $menu->link }}" @click.outside="$wire.set('editFieldRowId', null)" />
                                            </div>
                                        @else
                                            <div wire:click="editRow('{{ $menu->id }}', 'link', '{{ $menu->link }}')" class="edit-icon" style="cursor: pointer;">
                                                {{ $menu->link ?? '---' }}
                                                <i class="bx bx-edit-alt text-warning icon-hover"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div wire:click="selectLogo({{ $menu->id }},'{{ $menu->logo }}')" style="cursor: pointer;">
                                            @if ($menu->logo)
                                                <img src="{{ asset('storage/' . $menu->logo) }}" alt="logo" class="w-px-40 h-auto rounded-circle">
                                            @else
                                                <img src="{{ asset('assets/images/tapin.svg') }}" alt="logo" class="w-px-40 h-auto rounded-circle">
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a onclick="konfirmasiHapus({{ $menu->id }}, '{{ $menu->menu }}')" type="button" class="text-danger"><i
                                                    class="bx bx-x"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="logoModal" tabindex="-1">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="avatarModalLabel">Ganti Logo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="mb-0">
                                @if ($this->logoEdit)
                                    <img src="{{ $this->logoEdit->temporaryUrl() }}" style="width:60px;">
                                @elseif ($this->selectedLogo)
                                    <img src="{{ asset('storage/' . $this->selectedLogo) }}" style="width:60px; cursor:pointer">
                                @else
                                    <img src="{{ asset('assets/images/tapin.svg') }}" style="width:60px;">
                                @endif
                            </div>
                        </div>

                        <div class="col">
                            <input wire:model="logoEdit" class="form-control form-control-md {{ $errors->has('logoEdit') ? 'is-invalid' : 'border border-secondary' }}" type="file">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('js')
    <script>
        function konfirmasiHapus(id, menu) {
            Swal.fire({
                title: 'Konfirmasi hapus',
                text: "Anda yakin ingin menghapus " + menu + " ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('hapus', {
                        id: id
                    });
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });

                    Toast.fire({
                        icon: "success",
                        title: menu + " telah dihapus."
                    });
                }
            });
        }

        window.addEventListener('open-modal', () => {
            let modal = new bootstrap.Modal($('#logoModal'));
            modal.show();
        });

        window.addEventListener('close-modal', () => {
            let modalEl = $('#logoModal');
            let modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();
        });
    </script>
@endpush
