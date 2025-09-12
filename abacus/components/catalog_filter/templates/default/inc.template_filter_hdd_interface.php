<div class="filter_field_block">
  <div class="filter_field_block__title">Накопитель <span
                v-if="filterSelectedHddSATA.length || filterSelectedHddmSATA.length || filterSelectedHddM2.length || filterSelectedHddPCIE.length"
                @click="clicked_button_clear_filter_field_block('filterSelectedHdd')"
                class="button_clear_filter_field_block">x</span> </div>
  <div class="columns is-gapless is-multiline">
    <div class="column is-6-widescreen is-12-desktop is-12-tablet">
      <input class="SATA" @change="filterChanged" v-model="filterSelectedHddSATA" type="checkbox"
                   id="checkbox_SATA"
                   value="yes"/>
      &nbsp;
      <label for="checkbox_SATA">SATA</label>
    </div>
    <div class="column is-6-widescreen is-12-desktop is-12-tablet">
      <input class="mSATA" @change="filterChanged" v-model="filterSelectedHddmSATA" type="checkbox"
                   id="checkbox_mSATA"
                   value="yes"/>
      &nbsp;
      <label for="checkbox_mSATA">mSATA</label>
    </div>
    <div class="column is-6-widescreen is-12-desktop is-12-tablet">
      <input class="M2" @change="filterChanged" v-model="filterSelectedHddM2" type="checkbox"
                   id="checkbox_M2"
                   value="yes"/>
      &nbsp;
      <label for="checkbox_M2">M.2</label>
    </div>
    <div class="column is-6-widescreen is-12-desktop is-12-tablet">
      <input class="PCIE" @change="filterChanged" v-model="filterSelectedHddPCIE" type="checkbox"
                   id="checkbox_PCIE"
                   value="yes"/>
      &nbsp;
      <label for="checkbox_PCIE">PCIE</label>
    </div>
  </div>
</div>
