# RF Frequency to Wavelength Calculator - Test Cases

This document contains test cases to verify the accuracy of the RF calculator against known correct values. Each test case includes the input frequency with its unit and the expected wavelength output in meters.

## Test Case Overview

The following test cases cover all supported frequency units (Hz, kHz, MHz, GHz) across a wide range of frequencies to ensure accurate calculations throughout the electromagnetic spectrum.

---

## Test Cases

### Low Frequency (Hz Range)

| Test Case | Input Frequency | Expected Wavelength | Notes |
|-----------|----------------|--------------------|--------------------|
| TC-001 | **10 Hz** | `29,979,245.8 m` | Extremely low frequency (ELF) |
| TC-002 | **100 Hz** | `2,997,924.58 m` | Very low frequency (VLF) |

### Medium Frequency (kHz Range)

| Test Case | Input Frequency | Expected Wavelength | Notes |
|-----------|----------------|--------------------|--------------------|
| TC-003 | **65 kHz** | `4,612.19166154 m` | Low frequency (LF) |
| TC-004 | **299 kHz** | `1,002.6503612 m` | Medium frequency (MF) |

### High Frequency (MHz Range)

| Test Case | Input Frequency | Expected Wavelength | Notes |
|-----------|----------------|--------------------|--------------------|
| TC-005 | **29 MHz** | `10.33767097 m` | High frequency (HF) - Ham radio |
| TC-006 | **566 MHz** | `0.52966865 m` | Ultra high frequency (UHF) - TV/Mobile |

### Very High Frequency (GHz Range)

| Test Case | Input Frequency | Expected Wavelength | Notes |
|-----------|----------------|--------------------|--------------------|
| TC-007 | **9 GHz** | `0.03331027 m` | Super high frequency (SHF) - Microwave |
| TC-008 | **497 GHz** | `0.0006032 m` | Extremely high frequency (EHF) - Terahertz |

---

## Testing Instructions

### Manual Testing Steps

1. Navigate to a page with the RF calculator (`[rf_calculator]` shortcode)
2. For each test case:
   - Enter the **Input Frequency** value
   - Select the appropriate **unit** from the dropdown
   - Click **Calculate**
   - Verify the result matches the **Expected Wavelength**

### Automated Testing

```javascript
// Example test case validation
const testCases = [
    { frequency: 10, unit: 'Hz', expected: 29979245.8 },
    { frequency: 100, unit: 'Hz', expected: 2997924.58 },
    { frequency: 65, unit: 'kHz', expected: 4612.19166154 },
    { frequency: 299, unit: 'kHz', expected: 1002.6503612 },
    { frequency: 29, unit: 'MHz', expected: 10.33767097 },
    { frequency: 566, unit: 'MHz', expected: 0.52966865 },
    { frequency: 9, unit: 'GHz', expected: 0.03331027 },
    { frequency: 497, unit: 'GHz', expected: 0.0006032 }
];
```

---

## Formula Verification

All test cases are calculated using the standard formula:

**λ = c / f**

Where:
- **λ (lambda)** = Wavelength in meters
- **c** = Speed of light = `299,792,458 m/s`
- **f** = Frequency in Hz

---

## Frequency Band Classification

| Frequency Range | Band Designation | Typical Applications |
|----------------|------------------|---------------------|
| 3-30 Hz | ELF (Extremely Low Frequency) | Power lines, brain waves |
| 30-300 Hz | SLF (Super Low Frequency) | Submarine communication |
| 3-30 kHz | VLF (Very Low Frequency) | Navigation, time signals |
| 30-300 kHz | LF (Low Frequency) | AM radio, navigation |
| 300 kHz-3 MHz | MF (Medium Frequency) | AM broadcast radio |
| 3-30 MHz | HF (High Frequency) | Amateur radio, shortwave |
| 30-300 MHz | VHF (Very High Frequency) | FM radio, TV, aviation |
| 300 MHz-3 GHz | UHF (Ultra High Frequency) | TV, mobile phones, GPS |
| 3-30 GHz | SHF (Super High Frequency) | Microwave, satellite |
| 30-300 GHz | EHF (Extremely High Frequency) | Millimeter wave, radar |

---

## Acceptance Criteria

### Pass Criteria
- Calculator output matches expected values within **±0.000001 m** tolerance
- All frequency units (Hz, kHz, MHz, GHz) function correctly
- Results display with appropriate decimal precision
- No JavaScript errors in browser console

### Additional Validation
- **Edge Cases**: Test with very small (0.1 Hz) and very large (999 GHz) frequencies
- **Precision**: Verify results maintain accuracy across all decimal places
- **Unit Conversion**: Confirm internal Hz conversion is accurate for all units

---

## Test Results Template

| Test Case | Status | Actual Result | Expected Result | Difference | Notes |
|-----------|--------|---------------|-----------------|------------|-------|
| TC-001 | ✅ PASS | 29,979,245.800000 | 29,979,245.8 | 0.000000 | |
| TC-002 | ✅ PASS | 2,997,924.580000 | 2,997,924.58 | 0.000000 | |
| TC-003 | ⏳ PENDING | | 4,612.19166154 | | |
| TC-004 | ⏳ PENDING | | 1,002.6503612 | | |
| TC-005 | ⏳ PENDING | | 10.33767097 | | |
| TC-006 | ⏳ PENDING | | 0.52966865 | | |
| TC-007 | ⏳ PENDING | | 0.03331027 | | |
| TC-008 | ⏳ PENDING | | 0.0006032 | | |

---

*Last Updated: [Date]*  
*Test Environment: WordPress [Version], Browser [Type/Version]*