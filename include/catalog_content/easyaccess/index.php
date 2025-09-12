<?php

CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css?" . rand());

//CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js");

?>

<div id="vue_app_easyaccess">

    <div class="columns is-multiline">

        <div class="column is-3-desktop is-12-mobile">

            <ul class="tabs__guide__caption">

                <li class="button is-fullwidth" @click="change_section(1)"

                    :class="{ 'is-success': current_section==1 }">����� � �����������

                </li>

                <li class="button is-fullwidth" @click="change_section(2)"

                    :class="{ 'is-success': current_section==2 }">��������� ���������� <br>� ���������

                </li>

                <li class="button is-fullwidth" @click="change_section(3)"

                    :class="{ 'is-success': current_section==3 }">������ ������

                </li>

                <li class="button is-fullwidth" @click="change_section(4)"

                    :class="{ 'is-success': current_section==4 }">���������� ������� <br>(���������)

                </li>

                <li class="button is-fullwidth" @click="change_section(5)"

                    :class="{ 'is-success': current_section==5 }">���������� ������ � �����<br>(Trial 30 ����)

                </li>

                <li class="button is-fullwidth" @click="change_section(6)"

                    :class="{ 'is-success': current_section==6 }">���������� ������ � �����<br></li>

                <li class="button is-fullwidth" @click="change_section(7)"

                    :class="{ 'is-success': current_section==7 }">EasyAccess 2.0 �� ��

                </li>

                <li class="button is-fullwidth" @click="change_section(8)"

                    :class="{ 'is-success': current_section==8 }">�����������

                </li>

            </ul>

        </div>

        <div class="column is-9-desktop is-12-mobile">

            <section>

                <div id="topper"></div>

                <div class="tabs__guide  vertical">

                    <div class="tabs__guide__content" v-if="current_section == 1">

                        <h2>����� � �����������</h2>

                        <h3>��� ����� EasyAccess 2.0?</h3>

                        <p>EasyAccess 2.0 ��� ������, � ������� �������� �� ������ �������� ������ � ����� �������

                            ��������� � ���

                            �� ����� ����� ����.

                            ��� ���������� ������������ ������ ��������� � �������� �� � ������ �������� EasyAccess 2.0

                            (�� �����

                            weincloud.net), � ���������, ��� ������ ����� ����� � ��������.

                            ����� ���������, �� ������� �������� � ���������� �������� � ��� � ����� ��������� ����.

                            ������

                            ���������� ������ ���� ���� ����� ����� ���������� IP.

                            ������, ������������ ����� ������ ���� �������� ���������� SSL 128 ���. ������ ��������

                            ������������

                            ������������ � ���������� �������� ������.</p>

                        <div class="columns">

                            <div class="column is-2-desktop is-12-mobile">

                                <div class="image_bg_cover"

                                     style="background-image: url('https://www.rusavtomatika.com/upload_files/images/icon-security.png')"></div>

                                <div class="under_text">������������ ����������� SSL</div>

                            </div>

                            <div class="column is-2-desktop is-12-mobile">

                                <div class="image_bg_cover"

                                     style="background-image: url('https://www.rusavtomatika.com/upload_files/images/icon-users.png')"></div>

                                <div class="under_text">���������� �������� �������������</div>

                            </div>

                            <div class="column is-2-desktop is-12-mobile">

                                <div class="image_bg_cover"

                                     style="background-image: url('https://www.rusavtomatika.com/upload_files/images/icon-circle2.png')"></div>

                                <div class="under_text">��� ����������� IP ������ ���������</div>

                            </div>

                            <div class="column is-2-desktop is-12-mobile">

                                <div class="image_bg_cover"

                                     style="background-image: url('https://www.rusavtomatika.com/upload_files/images/icon-passphrough.png')"></div>

                                <div class="under_text">PassThrough � ���������� PLC ����� HMI</div>

                            </div>

                            <div class="column is-2-desktop is-12-mobile">

                                <div class="image_bg_cover"

                                     style="background-image: url('https://www.rusavtomatika.com/upload_files/images/icon-ipad2.png')"></div>

                                <div class="under_text">���������� HMI � ��������� ���������</div>

                            </div>

                        </div>

                        <h2>

                            ��� ���� ����� EasyAccess 2.0?

                        </h2>

                        <p>

                            � ��������� ����� ��� ������ ����� ���������� ������� �� ��������� ���������� ��������

                            ���������.

                            ���� � ��� ������ �������� ����������� � ������ ���������, ������� ����������� �� �����

                            ������������, ��

                            ��� ����� ������ IP ����� ����� ������, ����� � ��� ������������. ��� ������ ���� �� ��

                            ������ ����� IP

                            � ������? ���� ��������� �������� ��� ��� �������.

                        </p>

                        <p>������ ������ � ��� ������������ ������������ � ������ �� �� ������ IP ������. ������ ������

                            ����� ���

                            �����������:</p>

                        <ul class="spisok">

                            <li>���������� ������� � ��������� �����, ����� �� ����� ��� ����� IP (������ ������, �����

                                ���

                                ����������)

                            </li>

                            <li>���������� ����������� ������� ������������</li>

                            <li>��� ������ ������ ����� ���� ���������� ����� IP</li>

                        </ul>

                        <p>������ ������ � ������������ EasyAccess 2.0.</p>

                        <p>� EasyAccess 2.0 �� ������������ �� �������, ��������� � ������ �������.

                            ������ ������ ������� ���������� ���� ����� ������ ������������, ������� ������� ����������

                            ����������

                            IP.

                            ��������� ������ IP �����, �� ������ �������� ������������ � ������� ��������� � ���������

                            ����������� �

                            ����.

                        </p>

                        <h2>��� ��������� ������ EasyAccess 2.0?</h2>

                        <ol class="spisok">

                            <li>��������� ������� ����� VNC-������, CMT Viewer (�������� ������ ��� ����� �������

                                ��������� CMT).

                                �� ������ ������, ��� ���������� �� ������ ����� ������, �������� ������.

                            </li>

                            <li>������������ ������</li>

                            <li>������������� ������ �������</li>

                            <li>��������� ����� ����� FTP. (���� ������ ������������ ftp)</li>

                            <li>����������� �����������</li>

                        </ol>

                        <div class="is-clearfix has-background-light mt-5">

                            <div class="button is-pulled-right is-success" @click="next_section">�����</div>

                        </div>

                    </div>

                    <div class="tabs__guide__content" v-if="current_section == 2">

                        <h2>��������� ���������� � ���������</h2>

                        <ul class="spisok">

                            <li>������������ �������: Windows XP, Windows 7, Windows 8 (32 / 64���), Windows 10 (32 /

                                64���)

                                (���������� ����� ��������������)

                            </li>

                            <li>������ ��������� Weintek � �������������� EasyAccess 2.0</li>

                            <li>��������-����������</li>

                            <li>EasyBuilder Pro v4.10.05 ��� �����</li>

                            <li>IOS: 7.0 ��� ������</li>

                            <li>Android: v4.1.2 ��� ������</li>

                        </ul>

                        <div class="is-clearfix has-background-light mt-5">

                            <div class="button is-pulled-right is-success" @click="next_section">�����</div>

                        </div>



                    </div>

                    <div class="tabs__guide__content" v-if="current_section == 3">

                        <h2>������ ������</h2>

                        <h3>������� ��������</h3>

                        <p>����� ������ ������������ EasyAccess 2.0, ����� ��������� ��������� ����. ��������

                            ���������������

                            �������, �������� ����������� ����.</p>

                        <ol class="spisok">

                            <li>������ ��������� ������ ���� ������������ (���� ���� ������ �� ����� ��� ��������������

                                EasyAccess2.0, �� ���������� � ����� ���������� � ������-����.)

                            </li>

                            <li>���������� ������� (���������) (����� 4)<br> ������ ���� ������ ������� (�����) �� �����

                                <a

                                        href="https://www.weincloud.net/">weincloud.net</a></li>

                            <li>���������� ������ � ����� (����� 6)<br>���� �� ������ ����������� 30 ������� ������, ��

                                ���������� �

                                (����� 5)<br>������ ��������� ������ ���� ��������� � �����

                            </li>

                            <li>���������� ������������ � �������� ��� ������� � ������<br>������ ���� ������� �������

                                ������

                                ������������, � ������� ����� ��������� ������ ���������

                            </li>

                            <li>EasyAccess 2.0 ������ ���� ���������� �� ��</li>

                        </ol>

                        <p>����� ����, ��� ��� ���� ���������, ������������ ������ �������� ������������ � ������

                            ���������</p>





                        <h2>��������� ������</h2>

                        <p>����� ������������ ������ ���������, ����� ������ ������������ EasyAccess 2.0.

                            � ��������� ������� ������� ��� �������������� ������ ���������, �������� <a

                                    href="/weintek/cMT3072/">cMT3072</a>.

                            � ����� ������� � ��� �� ����� �������� ��������� EasyAccess 2.0 ������ � ����������.

                            � ���� ������ ��� ���������� ���������� � ���, ����� ������������ ���� ������.

                            ����� ���������, ��� ���� ������ ������������ EasyAccess 2.0.

                            ������, ������� ������������ ������ ���������� ����� ������� ���������� ������ ��

                            EasyAccess�.</p>



                        <h2>������������</h2>



                        <ul class="spisok">

                            <li><b>����� � �������������� ������</b>

                                <p>������� ���������� �������, � �������� ������������� ������ ���������.

                                    <b>������ ��������� ����� ���� ��������� ������ � ������ ������.</b>

                                    �������������� ������, ��� ������������, ������� ����� ��������� �������� ���������

                                    � �������������� ����� ��� ��������� �� ����� (<a href="https://www.weincloud.net/">weincloud.net</a>).

                                    ������� �������������� ������ �� ������������ ��� ����� � ���������� ���������

                                    EasyAccess 2.0.

                                </p></li>

                            <li><b>������ ������� ���������</b>

                                <p>������ ��������� ����� ���������� � ������. ����� ������ ����� ���������

                                    �������������.

                                    ������������ ������� ����������� ��������� ����� �������� �� ������, ������� ��

                                    ���������.

                                    ������ ��������� ����� ���� ��������� � ������ ������. ������ ��������� � ���������

                                    ������������� ������.</p></li>

                            <li>

                                <b>������������</b>

                                <p>������������ � ��� �������, ������� ����� �������������� � ���������� ���������

                                    EasyAccess 2.0 � �������� ��������� �������� ���������, � ����� �������� �������,

                                    ������� ����� ��� �������� ������������� ������.</p></li>

                        </ul>





                        <h2>������ ������������� ����</h2>

                        <p>���������� ��������� ������� ��� ��������������� ������� ������.</p>

                        <ol class="spisok">

                            <li>� ���� ������� ����� � ������ ���� ����� ����� ���� �������������, ����� � ����.</li>

                            <li>� ���� ������� ������ ��������� ������������� � ������: ������ 1, ������ 2, ������ 3 �

                                �.�. ������

                                ��������� A ����������� � ���� �������

                            </li>

                            <li>������������ ����� ������������ �� ������ �������. � ��� �� ����� ������ � �������

                                ���������,

                                ������� �� ����� ������. (������������ ���� � ������ 1)

                            </li>

                            <li>������������ ����� ���� �������� ������� � �������� ��������� � ����� � ��� ������.

                                (������������

                                ���� � ������ ��������� J).

                                ��������� ������������� ����� �������� ������ � ����� � ��� �� ������ ���������,

                                ���������� �� ����, ��������� �� ��� ������� (������� ��������� �) ��� ����� ������

                                ����� (������

                                ��������� H).

                            </li>

                        </ol>

                        <p>������� ������������� ��������������� ������. </p>



                        <p style="text-align: center"><a class="img__easyaccess"

                                                         href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/mceclip1.webp"

                                                         data-fancybox="gallery0"><img loading="lazy"

                                                                                       src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/mceclip1.webp"></a>

                        </p>

                        <div class="is-clearfix has-background-light mt-5">

                            <div class="button is-pulled-right is-success" @click="next_section">�����</div>

                        </div>





                    </div>

                    <div class="tabs__guide__content" v-if="current_section == 4">

                        <h2>���������� ������� (���������)</h2>

                        <h3>�������� �������� (������)</h3>

                        <ol>

                            <li><p>������� ���������� �������� ��������� �� ������: <a href="https://www.weincloud.net/">weincloud.net</a>

                                </p>

                                <p>������� �� ����, ������� ������ [Create Domain account] � ���������� � ����������

                                    ����� ������

                                    �������</p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/1.webp"

                                                                 data-fancybox="gallery1"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/1.webp"></a>

                                </p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/2.webp"

                                                                 data-fancybox="gallery1"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/2.webp"></a>

                                </p>

                            </li>

                            <li>

                                <p>���� �� ��� ��������� �����, �� ��� �� ����� ������ ������ �� ������� ��

                                    �������������. �������

                                    ��� ������ � ����������� ����������� ��������� �� ������.</p>

                                <p>������ ����� �������������� � ������� ���������� �������. ��� ����� �� �������

                                    ��������

                                    <a href="https://www.weincloud.net/">weincloud.net</a> ������� ������ [Domain]

                                </p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/3.webp"

                                                                 data-fancybox="gallery1"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/3.webp"></a>

                                </p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/4.webp"

                                                                 data-fancybox="gallery1"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/4.webp"></a>

                                </p>

                            </li>

                        </ol>





                        <h2>���������� ������������ � �������� ��� �������</h2>



                        <ol>

                            <li>

                                <p>������� ������� [User] (������������). �� ����� �������� � ������ ��� ���� ����

                                    ������������.

                                    ��� ������ ���������� ����� ������. ������� ������ [+Add User] ��� ����������

                                    ������������. </p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/13.webp"

                                                                 data-fancybox="gallery3"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/13.webp"></a>

                                </p>

                            </li>

                            <li>

                                <p>��� ������ ������������ ������� ����� � ��� �����, �� ������� ������ ���������������

                                    ������������� ������. </p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/14.webp"

                                                                 data-fancybox="gallery3"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/14.webp"></a>

                                </p>

                            </li>

                            <li>

                                <p> ������� ������ � ������. �������� �� � ������� ������ �������������� ��� ������

                                    [Edit HMI].

                                    �������� �������� ������� ������������ � ������� [Save].</p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/15.webp"

                                                                 data-fancybox="gallery3"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/15.webp"></a>

                                </p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/16.webp"

                                                                 data-fancybox="gallery3"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/16.webp"></a>

                                </p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/17.webp"

                                                                 data-fancybox="gallery3"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/17.webp"></a>

                                </p>

                            </li>

                        </ol>

                        <div class="is-clearfix has-background-light mt-5">

                            <div class="button is-pulled-right is-success" @click="next_section">�����</div>

                        </div>



                    </div>

                    <div class="tabs__guide__content" v-if="current_section == 5">

                        <h2>���������� ������ � ����� (Trial 30 ����)</h2>

                        <ol>

                            <li>

                                <p>� ����� ������ �� ����� <a href="https://www.weincloud.net/">weincloud.net</a>, �� �������

                                    "Devices" -

                                    "HMI List" ������� ������ [+ Add HMI]</p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/5.webp"

                                                                 data-fancybox="gallery2"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/5.webp"></a>

                                </p>

                            </li>

                            <li>

                                <p>�������� ��� ���������: 30 days Free Trial</p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/6.webp"

                                                                 data-fancybox="gallery2"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/6.webp"></a>

                                </p>



                                <p>������� Hardware key (���������� ����) � ����������� �� ������� [Free Trial].</p>



                                <p>HWkey (Hardware key - ���������� ����) �� ������ ������, ����� � ����� ������ ��

                                    ��������

                                    ��������� �������� [System Settings] �� ������� [EasyAccess 2]</p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/7.webp"

                                                                 data-fancybox="gallery2"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/7.webp"></a>

                                </p>

                            </li>

                        </ol>

                        <div class="is-clearfix has-background-light mt-5">

                            <div class="button is-pulled-right is-success" @click="next_section">�����</div>

                        </div>



                    </div>

                    <div class="tabs__guide__content" v-if="current_section == 6">

                        <h2>���������� ������ � �����</h2>

                        <ol>

                            <li>

                                <p>��������� � ������ ����������� � �������� �� HW-key (Hardware key - ���������� ����).

                                    ��� ������

                                    ���� �������� � ���������� ����.

                                    �� ���������� ���, ��� ��������� ���������.</p>

                            </li>

                            <li>

                                <p>� ������� ��������� EasyBuilderPro ����� ������� � ��������� � ������ ������,

                                    �����������

                                    ��������� �� ������ �������� � ����������� EasyAccess 2.0.

                                    �������� � EasyBuilderPro ����� ������. </p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/8.webp"

                                                                 data-fancybox="gallery3"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/8.webp"></a>

                                </p>

                            </li>

                            <li>

                                <p>� ��������� ���������� ��������� ������������ ������� EasyAccess2.0. ������ ����

                                    ������

                                    "����������"</p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/9.webp"

                                                                 data-fancybox="gallery3"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/9.webp"></a>

                                </p>

                            </li>

                            <li>

                                <p>�������� �������������� ������, ������� ��������� ���� �76 EasyAccess 2.0 Settings.

                                    ���������

                                    ������ � ������.</p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/10.webp"

                                                                 data-fancybox="gallery3"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/10.webp"></a>

                                </p>

                            </li>

                            <li>

                                <p>������ � ����� ������� ����� ������ ���� ������, ��� ������� �������, ��������� ����

                                    �

                                    ����������� EasyAccess 2.0.

                                    ���������� ���� ������ � ��������� � �������� ���� EasyAccess 2.0. ����� �������

                                    ������ [Start]

                                    � ����� [Session ID] � [Password] �������� ��������,

                                    ������� ��� ����� ����� � ��������� ����.</p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/11.webp"

                                                                 data-fancybox="gallery3"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/11.webp"></a>

                                </p>

                            </li>

                            <li>

                                <p>� ����� ������ �� ����� <a href="https://www.weincloud.net/">weincloud.net</a>, �� �������

                                    "Devices" -

                                    "HMI List" ������� ������ [+ Add HMI]</p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/5.webp"

                                                                 data-fancybox="gallery2"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/5.webp"></a>

                                </p>

                            </li>

                            <li>

                                <p> �������� ��� ���������: [Add by session Id/password]. ������� Session ID �

                                    [Password],

                                    ���������� �� ���������� ����. ����������� ������� [Assign]. �� �������� ������

                                    ��������� �

                                    �����. ������ ����� ������� ������������ � ������� ��� ������ � ������.</p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/12.webp"

                                                                 data-fancybox="gallery3"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/12.webp"></a>

                                </p>

                            </li>

                        </ol>

                        <div class="is-clearfix has-background-light mt-5">

                            <div class="button is-pulled-right is-success" @click="next_section">�����</div>

                        </div>



                    </div>

                    <div class="tabs__guide__content" v-if="current_section == 7">

                        <h2>EasyAccess 2.0 �� ��</h2>

                        <p>EasyAccess 2.0 ��������������� ��� ��������� ���������, ������� ����� ���������� �� ��. ��

                            �����

                            �������������� ���������� �� ������������ ������ EasyBuilder.</p>

                        <p><a href="/soft/EasyAccess/EasyAccess20_setup.zip">

                                <div class="download__inner" style="width: 250px;">

                                    <div class="download__img" style="background-image: url(/images/zip.svg)"></div>

                                    <div class="download__text">

                                        <div class="download__text__title">����������� ver 2.3.0 ��� PC</div>

                                        <div class="download__text__p">[23-11-2016 65.12 ��]</div>

                                    </div>

                                    <div class="clearfix"></div>

                                </div>

                            </a></p>

                        <h3>�����������</h3>

                        <p>��������� ��� ������, ��� ������������ ������, ������.</p>

                        <p style="text-align: center"><a class="img__easyaccess"

                                                         href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea1.webp"

                                                         data-fancybox="gallery3"><img loading="lazy"

                                                                                       src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea1.webp"></a>

                        </p>

                        <h3>������� �����</h3>

                        <p>����� ����, ��� �� ������� � �������, �� ��������� �� ������� ������.

                            ��� ������������ ��� ������ ��������� ��������� ������������.

                            ����� ������������ ������� �������. �� ������ ������������ � ��������������� ����������

                            �������.

                            ������ ����� ����, ��� �� ������������ � ������, �� ��� ������ �������� ������ �������.

                            � ����� ������ ������ ����� �� ������ ������������, �� ��� ���, ���� �� �� ����� ���������

                            �������

                            ����������.</p>

                        <p style="text-align: center"><a class="img__easyaccess"

                                                         href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea2.webp"

                                                         data-fancybox="gallery3"><img loading="lazy"

                                                                                       src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea2.webp"></a>

                        </p>

                        <p><b>������� ������ �� ������� ������:</b></p>

                        <table class="eatable">

                            <tbody>

                            <tr>

                                <td>������</td>

                                <td>�������</td>

                            </tr>

                            <tr>

                                <td style="width: 260px;"><p style="text-align: left"><img loading="lazy"

                                                                                           src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea3.webp">

                                    </p></td>

                                <td>������ ������</td>

                            </tr>

                            <tr>

                                <td style="width: 260px;"><p style="text-align: left"><img loading="lazy"

                                                                                           src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea4.webp">

                                    </p></td>

                                <td>����� ������ ���������</td>

                            </tr>

                            <tr>

                                <td style="width: 260px;"><p style="text-align: left"><img loading="lazy"

                                                                                           src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea5.webp">

                                    </p></td>

                                <td>

                                    ���: ������/������

                                </td>

                            </tr>

                            <tr>

                                <td style="width: 260px;"><p style="text-align: left"><img loading="lazy"

                                                                                           src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea6.webp">

                                    </p></td>

                                <td>���������</td>

                            </tr>

                            <tr>

                                <td style="width: 260px;"><p style="text-align: left"><img loading="lazy"

                                                                                           src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea7.webp">

                                    </p></td>

                                <td>����� �� �������� ������������</td>

                            </tr>

                            <tr>

                                <td style="width: 260px;"><p style="text-align: left"><img loading="lazy"

                                                                                           src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea8.webp">

                                    </p></td>

                                <td>������� �����������</td>

                            </tr>

                            </tbody>

                        </table>



                        <h3>��������� ������ ��������� � ��������� �������</h3>

                        <p>������ ��������� ����� ���������� � ����� �� ���������: ������, ������, ���������,

                            ������.</p>

                        <table class="eatable">

                            <tbody>

                            <tr style="border-bottom: none;">

                                <td><p style="text-align: left"><img loading="lazy"

                                                                     src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea9.webp">

                                    </p></td>

                                <td><p style="text-align: left"><img loading="lazy"

                                                                     src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea10.webp">

                                    </p></td>

                            </tr>

                            <tr>

                                <td>������</td>

                                <td>������</td>

                            </tr>

                            <tr style="border-bottom: none;">

                                <td><p style="text-align: left"><img loading="lazy"

                                                                     src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea11.webp">

                                    </p></td>

                                <td><p style="text-align: left"><img loading="lazy"

                                                                     src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea12.webp">

                                    </p></td>

                            </tr>

                            <tr>

                                <td>�������</td>

                                <td>������</td>

                            </tr>

                            </tbody>

                        </table>

                        <div class="is-clearfix has-background-light mt-5">

                            <div class="button is-pulled-right is-success" @click="next_section">�����</div>

                        </div>



                    </div>

                    <div class="tabs__guide__content" v-if="current_section == 8">



                        <h2>����������� EasyAccess 2.0</h2>



                        <ul style="margin-left:25px;">

                            <li>���������� �����������</li>

                            <li>���������� ������� � ������� ����� ���������������� ������ ���������</li>

                            <li>������������ ���������� ������������� ������� ����� ������������ � ������ ��������� �

                                ���� �����

                            </li>

                            <li>����</li>

                            <li>Ethernet-Ethernet Pass-through</li>

                        </ul>

                        <div class="is-clearfix has-background-light mt-5">

                            <div class="button is-pulled-right is-success" @click="change_section(1)">� ������</div>

                        </div>



                    </div>

                </div>

            </section>

        </div>

    </div>

    <section style="margin-top: 50px;">

        <h2>�����</h2>

        <div class="columns">

            <div class="column is-4-desktop is-12-mobile">

                <h3>EasyAccess 2.0 - ����������� � ��������� ������ ��� ����������� IP ������</h3>

                <iframe width="100%" height="315" src="https://www.youtube.com/embed/KViooU5gljA"

                        title="YouTube video player" frameborder="0"

                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"

                        allowfullscreen></iframe>

                <!--iframe width="100%" height="315" src="https://www.youtube.com/embed/KViooU5gljA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe-->





            </div>

            <div class="column is-4-desktop is-12-mobile">

                <h3>��������� ����������� � ������ ��������� Weintek ����� EasyAccess 2.0</h3>

                <iframe width="100%" height="315" src="https://www.youtube.com/embed/nTNuSA2aQcg"

                        title="YouTube video player" frameborder="0"

                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"

                        allowfullscreen></iframe>

                <!--iframe width="100%" height="315" src="https://www.youtube.com/embed/nTNuSA2aQcg" frameborder="0"                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"                    allowfullscreen></iframe-->



            </div>

            <div class="column is-4-desktop is-12-mobile">

                <h3>EasyAccess 2.0 ��������������������� ����������</h3>

                <iframe width="100%" height="315" src="https://www.youtube.com/embed/XhrRn2tuig0?rel=0"

                        title="YouTube video player" frameborder="0"

                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"

                        allowfullscreen></iframe>

                <!--iframe width="100%" height="315" src="https://www.youtube.com/embed/XhrRn2tuig0?rel=0" frameborder="0"                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"                    allowfullscreen></iframe-->



            </div>

        </div>



    </section>

    <section>

        <h2>�������</h2>

        <div class="columns">

            <div class="column is-4-desktop is-12-mobile">

                <a href="/soft/EasyAccess/EasyAccess20_manual.pdf">

                    <div class="download__inner">

                        <div class="download__img" style="background-image: url(/images/pdf.svg)"></div>

                        <div class="download__text">

                            <div class="download__text__title">����������� (eng)</div>

                            <div class="download__text__p">[3.6 ��]</div>

                        </div>

                        <div class="clearfix"></div>

                    </div>

                </a>

            </div>

            <div class="column is-4-desktop is-12-mobile">

                <a href="https://play.google.com/store/apps/details?id=com.weintek.easyaccess">

                    <div class="download__inner">

                        <div class="download__img" style="background-image: url(/images/android.svg)"></div>

                        <div class="download__text">

                            <div class="download__text__title">����������� ��� Android</div>

                            <div class="download__text__p">[��������� ������]</div>

                        </div>

                        <div class="clearfix"></div>

                    </div>

                </a>

            </div>

            <div class="column is-4-desktop is-12-mobile">

                <a href="/soft/EasyAccess/EasyAccess20_setup.zip">

                    <div class="download__inner">

                        <div class="download__img" style="background-image: url(/images/zip.svg)"></div>

                        <div class="download__text">

                            <div class="download__text__title">����������� ��� PC</div>

                            <div class="download__text__p">[69 ��]</div>

                        </div>

                        <div class="clearfix"></div>

                    </div>

                </a>

            </div>

        </div>

    </section>

</div>





