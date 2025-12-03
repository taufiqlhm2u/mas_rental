<x-layout>
    <x-slot:title>Dashboard</x-slot:title>

    <div class="mt-2"
        style="width: 100%; height: 300px; background-image: url(' {{ asset('img/dashboard.jpg') }}'); background-size: cover; background-position: center;">
    </div>
    <div class="d-flex justify-content-evenly m-4" id="quickinfo">

        <div class="card border-0 kartu" style="width: 200px; height: 80px;" id="user">
            <div class="py-2 px-3">
                <span>User</span>
                <div style="height:50px; display: flex; justify-content: start;">
                    <p style="display:flex; align-items: center; gap:5px;"><i class="ri-user-line"></i> <span
                            style="font-size: 28px; font-weight: 400;">{{ $jumlahUser }}</span></p>
                </div>
            </div>
        </div>

        <div class="card border-0 kartu" style="width: 200px; height: 80px;" id="kendaraan">
            <div class="py-2 px-3">
                <span>Kendaraan</span>
                <div style="height:50px; display: flex; justify-content: start;">
                    <p style="display:flex; align-items: center; gap:5px;"><i class="ri-car-line"></i> <span
                            style="font-size: 28px; font-weight: 400;">30</span></p>
                </div>
            </div>
        </div>

        <div class="card border-0 kartu" style="width: 200px; height: 80px;" id="rental">
            <div class="py-2 px-3">
                <span>Sedag di pinjam</span>
                <div style="height:50px; display: flex; justify-content: start;">
                    <p style="display:flex; align-items: center; gap:5px;"><i class="ri-p2p-fill"></i> <span
                            style="font-size: 28px; font-weight: 400;">30</span></p>
                </div>
            </div>
        </div>

        <div class="card border-0 kartu" style="width: 200px; height: 80px;" id="tempo">
            <div class="py-2 px-3">
                <span>Jatuh tenpo hari ini</span>
                <div style="height:50px; display: flex; justify-content: start;">
                    <p style="display:flex; align-items: center; gap:5px;"><i class="ri-calendar-schedule-line"></i> <span
                            style="font-size: 28px; font-weight: 400;">30</span></p>
                </div>
            </div>
        </div>
    </div>

    <style>
        #quickinfo .kartu {
            transition: ease 0.5s;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.5);
        }

        #quickinfo #user {
            background: #D8EEFE;
             color: #2994F2;
        }

        #quickinfo #user:hover {
            color: #D8EEFE;
             background-color: #2994F2;
             transform: scale(1.1);
        }

        #quickinfo #kendaraan {
            background: #E8E3FD; 
            color: #6E42F5;
        }

        #quickinfo #kendaraan:hover {
            color: #E8E3FD; 
            background-color: #6E42F5;
            transform: scale(1.1);
        }

        #quickinfo #rental {
           background: #FFF6D7;
           color: #E2A20B;
        }

         #quickinfo #rental:hover {
           color: #FFF6D7;
           background-color: #E2A20B;
            transform: scale(1.1);
        }

        #quickinfo #tempo {
           background: #FFE1E1;
            color: #D93025; 
        }

         #quickinfo #tempo:hover {
        color: #FFE1E1;
            background-color: #D93025; 
            transform: scale(1.1);
        }
    </style>
</x-layout>