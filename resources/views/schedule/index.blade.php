@extends('layouts.header')

@section('content-header')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-body p-0">
                            <!-- THE CALENDAR -->
                            <div id="calendar" class="fc fc-media-screen fc-direction-ltr fc-theme-bootstrap">
                                <div class="fc-header-toolbar fc-toolbar fc-toolbar-ltr">
                                    <div class="fc-toolbar-chunk">
                                        <div class="btn-group">
                                            <button class="fc-prev-button btn btn-primary" type="button"
                                                    aria-label="prev"><span class="fa fa-chevron-left"></span></button>
                                            <button class="fc-next-button btn btn-primary" type="button"
                                                    aria-label="next"><span class="fa fa-chevron-right"></span></button>
                                        </div>
                                        <button class="fc-today-button btn btn-primary" type="button">Hoje</button>
                                    </div>
                                    <div class="fc-toolbar-chunk"><h2 class="fc-toolbar-title">March 2021</h2></div>
                                    <div class="fc-toolbar-chunk">
                                        <div class="btn-group">
                                            <button class="fc-dayGridMonth-button btn btn-primary active" type="button">
                                                Mês
                                            </button>
                                            <button class="fc-timeGridWeek-button btn btn-primary" type="button">Semana
                                            </button>
                                            <button class="fc-timeGridDay-button btn btn-primary" type="button">Dia
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="fc-view-harness fc-view-harness-active" style="height: 661.481px;">
                                    <div class="fc-daygrid fc-dayGridMonth-view fc-view">
                                        <table class="fc-scrollgrid table-bordered fc-scrollgrid-liquid">
                                            <thead>
                                            <tr class="fc-scrollgrid-section fc-scrollgrid-section-header ">
                                                <td>
                                                    <div class="fc-scroller-harness">
                                                        <div class="fc-scroller" style="overflow: hidden;">
                                                            <table class="fc-col-header " style="width: 904px;">
                                                                <colgroup></colgroup>
                                                                <tbody>
                                                                <tr>
                                                                    <th class="fc-col-header-cell fc-day fc-day-sun">
                                                                        <div class="fc-scrollgrid-sync-inner"><a
                                                                                class="fc-col-header-cell-cushion ">Sun</a>
                                                                        </div>
                                                                    </th>
                                                                    <th class="fc-col-header-cell fc-day fc-day-mon">
                                                                        <div class="fc-scrollgrid-sync-inner"><a
                                                                                class="fc-col-header-cell-cushion ">Mon</a>
                                                                        </div>
                                                                    </th>
                                                                    <th class="fc-col-header-cell fc-day fc-day-tue">
                                                                        <div class="fc-scrollgrid-sync-inner"><a
                                                                                class="fc-col-header-cell-cushion ">Tue</a>
                                                                        </div>
                                                                    </th>
                                                                    <th class="fc-col-header-cell fc-day fc-day-wed">
                                                                        <div class="fc-scrollgrid-sync-inner"><a
                                                                                class="fc-col-header-cell-cushion ">Wed</a>
                                                                        </div>
                                                                    </th>
                                                                    <th class="fc-col-header-cell fc-day fc-day-thu">
                                                                        <div class="fc-scrollgrid-sync-inner"><a
                                                                                class="fc-col-header-cell-cushion ">Thu</a>
                                                                        </div>
                                                                    </th>
                                                                    <th class="fc-col-header-cell fc-day fc-day-fri">
                                                                        <div class="fc-scrollgrid-sync-inner"><a
                                                                                class="fc-col-header-cell-cushion ">Fri</a>
                                                                        </div>
                                                                    </th>
                                                                    <th class="fc-col-header-cell fc-day fc-day-sat">
                                                                        <div class="fc-scrollgrid-sync-inner"><a
                                                                                class="fc-col-header-cell-cushion ">Sat</a>
                                                                        </div>
                                                                    </th>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="fc-scrollgrid-section fc-scrollgrid-section-body  fc-scrollgrid-section-liquid">
                                                <td>
                                                    <div class="fc-scroller-harness fc-scroller-harness-liquid">
                                                        <div class="fc-scroller fc-scroller-liquid-absolute"
                                                             style="overflow: hidden auto;">
                                                            <div class="fc-daygrid-body fc-daygrid-body-unbalanced "
                                                                 style="width: 904px;">
                                                                <table class="fc-scrollgrid-sync-table"
                                                                       style="width: 904px; height: 629px;">
                                                                    <colgroup></colgroup>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td class="fc-daygrid-day fc-day fc-day-sun fc-day-future fc-day-other"
                                                                            data-date="2021-02-28">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">28</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-mon fc-day-future"
                                                                            data-date="2021-03-01">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">1</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-tue fc-day-future"
                                                                            data-date="2021-03-02">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">2</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-wed fc-day-future"
                                                                            data-date="2021-03-03">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">3</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-thu fc-day-future"
                                                                            data-date="2021-03-04">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">4</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-fri fc-day-future"
                                                                            data-date="2021-03-05">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">5</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-sat fc-day-future"
                                                                            data-date="2021-03-06">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">6</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="fc-daygrid-day fc-day fc-day-sun fc-day-future"
                                                                            data-date="2021-03-07">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">7</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-mon fc-day-future"
                                                                            data-date="2021-03-08">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">8</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-tue fc-day-future"
                                                                            data-date="2021-03-09">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">9</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-wed fc-day-future"
                                                                            data-date="2021-03-10">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">10</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-thu fc-day-future"
                                                                            data-date="2021-03-11">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">11</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-fri fc-day-future"
                                                                            data-date="2021-03-12">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">12</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-sat fc-day-future"
                                                                            data-date="2021-03-13">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">13</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="fc-daygrid-day fc-day fc-day-sun fc-day-future"
                                                                            data-date="2021-03-14">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">14</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-mon fc-day-future"
                                                                            data-date="2021-03-15">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">15</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-tue fc-day-future"
                                                                            data-date="2021-03-16">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">16</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-wed fc-day-future"
                                                                            data-date="2021-03-17">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">17</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-thu fc-day-future"
                                                                            data-date="2021-03-18">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">18</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-fri fc-day-future"
                                                                            data-date="2021-03-19">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">19</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-sat fc-day-future"
                                                                            data-date="2021-03-20">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">20</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="fc-daygrid-day fc-day fc-day-sun fc-day-future"
                                                                            data-date="2021-03-21">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">21</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-mon fc-day-future"
                                                                            data-date="2021-03-22">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">22</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-tue fc-day-future"
                                                                            data-date="2021-03-23">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">23</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-wed fc-day-future"
                                                                            data-date="2021-03-24">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">24</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-thu fc-day-future"
                                                                            data-date="2021-03-25">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">25</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-fri fc-day-future"
                                                                            data-date="2021-03-26">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">26</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-sat fc-day-future"
                                                                            data-date="2021-03-27">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">27</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="fc-daygrid-day fc-day fc-day-sun fc-day-future"
                                                                            data-date="2021-03-28">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">28</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-mon fc-day-future"
                                                                            data-date="2021-03-29">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">29</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-tue fc-day-future"
                                                                            data-date="2021-03-30">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">30</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-wed fc-day-future"
                                                                            data-date="2021-03-31">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">31</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-thu fc-day-future fc-day-other"
                                                                            data-date="2021-04-01">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">1</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-fri fc-day-future fc-day-other"
                                                                            data-date="2021-04-02">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">2</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-sat fc-day-future fc-day-other"
                                                                            data-date="2021-04-03">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">3</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="fc-daygrid-day fc-day fc-day-sun fc-day-future fc-day-other"
                                                                            data-date="2021-04-04">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">4</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-mon fc-day-future fc-day-other"
                                                                            data-date="2021-04-05">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">5</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-tue fc-day-future fc-day-other"
                                                                            data-date="2021-04-06">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">6</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-wed fc-day-future fc-day-other"
                                                                            data-date="2021-04-07">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">7</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-thu fc-day-future fc-day-other"
                                                                            data-date="2021-04-08">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">8</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-fri fc-day-future fc-day-other"
                                                                            data-date="2021-04-09">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">9</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fc-daygrid-day fc-day fc-day-sat fc-day-future fc-day-other"
                                                                            data-date="2021-04-10">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-top"><a
                                                                                        class="fc-daygrid-day-number">10</a>
                                                                                </div>
                                                                                <div
                                                                                    class="fc-daygrid-day-events"></div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
