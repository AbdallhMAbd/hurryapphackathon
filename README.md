# Gap Detection in Frame Sequences

This repository demonstrates two different PHP solutions (`solution1` and `solution2`) for detecting **missing ranges (gaps)** between sorted frames, identifying the **largest gap**, and calculating the **total missing count**.

---

## Overview

Both solutions:
- Take an unsorted list of frame numbers.
- Sort the frames.
- Find **gaps** where consecutive numbers are missing.
- Return:
  - `gaps`: list of `[start, end]` pairs,
  - `largest_gap`: the biggest missing range,
  - `missing_count`: the total number of missing frames.

---

## Solutions

### solution1
- **Method:** Looks only at **adjacent sorted frames**.
- **Gap detection:** Difference-of-neighbors → `b - a - 1`.
- **Largest gap tracking:** Updates with a concise short-circuit operation.
- **Efficiency:**  
  - Time: `O(n log n)` (sorting) + `O(n)` (gap finding).  
  - Space: `O(g)` (where `g` = number of gaps).
- **Best for:** Large or sparse ranges (efficient and memory-friendly).

---

### solution2
- **Method:** Builds the **entire range** from min → max frame and scans through it.
- **Gap detection:** Tracks when entering/exiting missing runs.
- **Largest gap tracking:** Uses a nested ternary with side effects.
- **Efficiency:**  
  - Time: `O(n log n)` (sorting) + `O(R × n)` (with linear membership checks).  
  - Space: `O(R + g)` (where `R` = full range length).
- **Best for:** Small, dense ranges where a full scan is reasonable.

---

## Comparison

| Aspect                | solution1                                | solution2                                        |
|-----------------------|------------------------------------------|--------------------------------------------------|
| Approach              | Adjacent differences                     | Full range scan with membership checks           |
| Post-Sort Complexity  | O(n)                                     | O(R × n) (as written) / O(R) with optimization   |
| Memory Usage          | O(g)                                     | O(R + g)                                         |
| Readability           | Simple, arithmetic-based                 | More complex; nested ternary                     |
| Large Ranges          | Efficient                                | Slow & memory-heavy                              |
| Largest Gap Update    | Short-circuit `&&`                       | Nested ternary                                   |

---

## Recommendation

- Use **solution1** for most practical cases (better performance and readability).  
- Use **solution2** only when working with **small, dense ranges** and if the range-scan logic better fits your problem domain.

---
